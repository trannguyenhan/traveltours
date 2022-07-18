<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CouponsRepository;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function __construct(CouponsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function checkCouponCode($couponCode){
        return $this->repository->checkCouponCode($couponCode);
    }

}
