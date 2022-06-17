<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public $regx = [
        'name' => 'required|max:255',
        'description' => 'required'
    ];
}
