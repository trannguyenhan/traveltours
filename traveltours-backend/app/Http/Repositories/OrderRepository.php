<?php

namespace App\Http\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{

    public function getModel(): string
    {
        return Order::class;
    }
}
