<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public $regx = [
        'id' => 'required',
        'name' => 'required|max:255',
        'description' => 'required'
    ];
}
