<?php

namespace App\Http\Repositories;

use App\Helper;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

class OrderRepository extends BaseRepository
{

    protected $_relationships = ['tour', 'user'];

    public function getModel(): string
    {
        return Order::class;
    }

    public function doStore($arr): JsonResponse
    {
        $arr['status'] = Order::PENNING;
        $arr['user_id'] = auth()->id();
        $total = $arr['child_count'] + $arr['adult_count'];
        $tour = Tour::find($arr['tour_id']);
        $max_slot = $tour->max_slot;
        $slot = $tour->slot;
        $NewDate = Date('Y-m-d', strtotime('+1 days'));
        $start_date = date($tour->start_date);
        if ($NewDate > $start_date) {
            return Helper::errorResponse("Không đặt được vì đã hết hạn");
        }
        if ($total <= 0) {
            return Helper::errorResponse("Bạn chưa chọn số người");
        }
        if ($slot + $total > $max_slot) {
            return Helper::errorResponse("Không đặt được chỗ vì đã hết slot");
        } else {
            $tour->slot = $slot + $total;
            $tour->save();
            return parent::doStore($arr);
        }
    }


    public function all($id): JsonResponse
    {
        $query = (new $this->_model)->query();
        $query = $this->relationships($query);
        $query = $query->where('user_id', '=', $id)->orderBy('created_at', 'desc');
        $total = $query->count();
        $result = $this->modifyResult($query->get()->toArray());

        return \App\Helper::successResponseList($result, $total);
    }

    public function checkBookTour($tourId, $userId): bool
    {
        $query = (new $this->_model)->query();
        $query = $query->where('user_id', '=', $userId)->where('tour_id', '=', $tourId)->where('status', '=', Order::ACCEPT);

        $total = $query->count();
        if ($total > 0) {
            return true;
        }
        return false;
    }


    public function accept($id)
    {
        $detail = $this->_model::find($id)->update(['status' => 'accept']);
        if ($detail) {
            $model =  ($this->_model->query()->find($detail));
            return \App\Helper::successResponse($model);
        }

        return \App\Helper::errorResponse("update fail!");
    }

    public function doList(
        $keyword,
        $page,
        $pageSize,
        $orderBy = ['created_at'],
        $orderType = ['desc'],
        $filter
    ): JsonResponse {

        $query = (new $this->_model)->query(); // create new query

        $query = $this->search($query, $keyword);
        $total = $query->count();
        $result = $query->get();

        $query = $query->skip(($page - 1) * $pageSize)->take($pageSize);

        $cnt = 0;
        $lengthType = count($orderType);
        foreach ($orderBy as $key) {
            if (Schema::hasColumn($this->_model->getTable(), $key)) {
                if ($cnt < $lengthType) {
                    $query->orderBy($key, $orderType[$cnt]);
                } else {
                    $query->orderBy($key, 'asc');
                }
            }
            $cnt++;
        }


        $query = $this->relationships($query);
        $result = $this->modifyResult($query->get()->toArray());

        return \App\Helper::successResponseList($result, $total);
    }

    public function doListSeller($keyword, $page, $pageSize, $orderBy = ['created_at'], $orderType = ['desc'], $filter): JsonResponse
    {
        $query = Order::query();

        [$created_by] = $filter;
        $query = $this->relationships($query);
        $result = $query->get();

        if ($created_by != null) {
            $result = $result->filter(function ($item) use ($created_by) {
                if ($item->tour != null) {
                    return $item->tour->created_by == $created_by;
                }
            });
        }

        if ($keyword != null) {
            $result = $result->filter(function ($item) use ($keyword) {
                return str_contains(strtolower($item->tour->name), strtolower($keyword));
            });
        }
        $total = count($result);
        $newResult = [];

        foreach ($result->forPage($page, $pageSize) as $item) {
            $newResult[] = $item;
        }

        $result = $newResult;


        return \App\Helper::successResponseList($newResult, $total);
    }
}
