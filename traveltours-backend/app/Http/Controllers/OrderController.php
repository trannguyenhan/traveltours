<?php

namespace App\Http\Controllers;

use App\Http\Repositories\OrderRepository;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Base\IdRequest;

class OrderController extends BaseController
{

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param $id
     * @return JsonResponse
     */
    public function all($id): JsonResponse
    {
        return $this->repository->all($id);
    }

    /**
     * @param StoreOrderRequest $request
     * @return mixed
     */
    public function store(StoreOrderRequest $request)
    {
        return $this->storeTemplate($request, Order::INSERT_FIELDS);
    }

    /**
     * @param $tourId
     * @param $userId
     * @return JsonResponse
     */
    public function checkBookTour($tourId, $userId): JsonResponse
    {
        $checking = $this->repository->checkBookTour($tourId, $userId);
        return \App\Helper::errorResponse($checking);
    }

    public function accept(IdRequest $request)
    {
        return $this->repository->accept($request->input('id'));
    }

    public function delete(IdRequest $request)
    {
        return $this->deleteTemplate($request);
    }
}
