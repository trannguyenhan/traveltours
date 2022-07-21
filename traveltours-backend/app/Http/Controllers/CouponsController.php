<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CouponsRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Coupon\StoreRequest;
use App\Http\Requests\Coupon\UpdateRequest;
use App\Models\Coupon;

class CouponsController extends BaseController
{
    public function __construct(CouponsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function checkCouponCode($couponCode){
        return $this->repository->checkCouponCode($couponCode);
    }

    public function store(StoreRequest  $request){
        return $this->storeTemplate($request, Coupon::INSERT_FIELDS);
    }

    public function update(UpdateRequest $request){
        return $this->updateTemplate($request, Coupon::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request)
    {
        return $this->deleteTemplate($request);
    }
}
