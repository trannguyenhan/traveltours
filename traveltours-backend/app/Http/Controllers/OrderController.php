<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrderRepository;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;

class OrderController extends BaseController
{

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param StoreOrderRequest $request
     * @return mixed
     */
    public function store(StoreOrderRequest $request){
        return $this->storeTemplate($request, Order::INSERT_FIELDS);
    }
}
