<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;

class StoreOrderRequest extends BaseRequest
{
    public $regx = [
        'tour_id' => 'required|exists:tours,id',
        'coupon_id' => 'exists:coupons,id',
        'user_id' => 'required|exists:users,id',
        'child_count' => 'required|numeric',
        'adult_count' => 'required|numeric',
        'total_price' => 'required|numeric',
        'tax' => 'required|numeric',
        'payment_method' => 'in:cod',
    ];
}
