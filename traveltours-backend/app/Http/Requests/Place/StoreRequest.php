<?php

namespace App\Http\Requests\Place;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public $regx = [
        'province' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'ward' => 'required|string|max:255',
        'address_detail' => 'required|string|max:500',
        'name' => 'required||string|max:255',
        'description' => 'required|string',
        'images' => 'array'
    ];
}
