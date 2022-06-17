<?php

namespace App\Http\Requests\TourGuide;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public $regx = [
        'id' => 'required',
        'name' => 'required|max:255',
        'phone_number' => 'required|max:15',
        'address' => 'required|max:255'
    ];
}
