<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public $regx = [
        'comment' => 'required|string|max:255',
        'user_id' => 'required|numeric|exists:users,id',
        'star' => 'required|numeric'
    ];
}
