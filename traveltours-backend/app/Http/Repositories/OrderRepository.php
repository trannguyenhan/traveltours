<?php

namespace App\Http\Repositories;

use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderRepository extends BaseRepository
{

    public function getModel(): string
    {
        return Order::class;
    }

    public function search($query, $keyword)
    {
        if(!auth()->user()->hasRole(ROLE_ADMIN)){
            $query = $query->where('user_id', auth()->id());
        }

        return parent::search($query, $keyword);
    }

    public function doStore($arr): JsonResponse
    {
        $arr['status'] = Order::PENNING;
        return parent::doStore($arr);
    }
}
