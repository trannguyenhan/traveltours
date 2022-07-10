<?php

namespace App\Http\Repositories;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use PHPUnit\Exception;

class OrderRepository extends BaseRepository
{

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
}
