<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;

class AcceptOrderRequest extends BaseRequest
{
    public $regx = [
        'tour_id' => 'required|exists:tours,id',
        'user_id' => 'required|exists:users,id',
    ];
}
