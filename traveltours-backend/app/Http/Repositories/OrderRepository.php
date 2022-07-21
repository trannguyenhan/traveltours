<?php

namespace App\Http\Repositories;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

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
        return parent::doStore($arr);
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
        $detail = $this->_model::find($id)->update(['status' => 'active']);
        if ($detail) {
            $model =  ($this->_model->query()->find($detail));
            return \App\Helper::successResponse($model);
        }

        return \App\Helper::errorResponse("update fail!");
    }
}
