<?php

namespace App\Http\Requests\Coupon;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public $regx = [
        'id' => 'required',
        'code' => 'required',
        'discount' => 'required|numeric',
        'start_date' => 'required',
        'end_date' => 'required',
        'threshold' =>  'required'
    ];
}
