<?php

namespace App\Http\Repositories;

use App\Helper;
use App\Models\Order;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;
use PHPUnit\Exception;

class OrderRepository extends BaseRepository
{

    protected $_relationships = ['tour'];

    public function getModel(): string
    {
        return Order::class;
    }

//    public function search($query, $keyword)
//    {
//        try {
//            if(!auth()->user()->hasRole(ROLE_ADMIN)){
//                $query = $query->where('user_id', auth()->id());
//            }
//        }
//        catch (\Exception $e){
//            return parent::search($query, $keyword);
//        }
//
//        return parent::search($query, $keyword);
//    }

    public function doStore($arr): JsonResponse
    {
        $arr['status'] = Order::PENNING;
        return parent::doStore($arr);
    }


    public function all($id): JsonResponse
    {
        $query = (new $this->_model)->query();
        $query = $this->relationships($query);
        $query = $query->where('user_id','=',$id)->orderBy('created_at','desc');
        $total = $query->count();
        $result = $this->modifyResult($query->get()->toArray());

        return \App\Helper::successResponseList($result, $total);
    }

    public function checkBookTour($tourId, $userId): bool
    {
        $query = (new $this->_model)->query();
        $query = $query->where('user_id','=',$userId)->where('tour_id','=',$tourId)->where('status','=','ok');
        $total = $query->count();
        if($total>0){
            print(1);
            return true;
        }
        print(0);
        return false;
    }
}
