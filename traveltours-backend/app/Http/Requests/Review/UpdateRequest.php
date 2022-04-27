<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public $regx = [
        'id' => 'required|numeric',
        'comment' => 'required|string|max:255',
        'user_id' => 'required|numeric|exists:users,id',
        'star' => 'required|numeric'
    ];
}
