<?php

namespace App\Http\Requests\Tour;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public $regx = [
        'id' => 'required|numeric',
        'dest' => 'required|numeric|exists:places,id',
        'range' => 'required|numeric',
        'start_date' => 'required',
        'slot' => 'required|numeric',
        'vehicle' => 'required|string|max:255',
        'hotel_star' => 'numeric',
        'places' => 'array'
    ];
}
