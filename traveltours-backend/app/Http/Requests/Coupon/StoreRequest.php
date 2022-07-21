<?php

namespace App\Http\Requests\Coupon;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public $regx = [
        'code' => 'required',
        'discount' => 'required|numeric',
        'start_date' => 'required',
        'end_date' => 'required',
        'threshold' =>  'required'
    ];
}
