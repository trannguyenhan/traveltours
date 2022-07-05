<?php

namespace App\Http\Requests\Tour;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public $regx = [
        // 'source' => 'required|numeric|exists:places,id',
        'dest' => 'required|numeric|exists:places,id',
        'range' => 'required|numeric',
        'start_date' => 'required',
        'slot' => 'required|numeric',
        'vehicle' => 'required|string|max:255',
        'hotel_star' => 'numeric',
        'categories' => 'array',
        'categories.*' => 'numeric',
        'places' => 'array'
    ];
}
