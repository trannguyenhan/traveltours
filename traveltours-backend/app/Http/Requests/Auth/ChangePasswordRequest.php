<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class ChangePasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string',
            'new_password' => [
                'required',
                'max:255'
            ],
            'password_confirmation' => 'required|same:new_password'
        ];
    }
}

