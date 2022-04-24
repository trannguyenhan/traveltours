<?php

namespace App\Http\Requests\Base;

use App\Http\Requests\BaseRequest;

class IdRequest extends BaseRequest
{
    public $regx = [
        'id' => 'required|numeric'
    ];
}
