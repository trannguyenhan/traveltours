<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:5,255',
            'email' => ['required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $user = User::query()->where('email', $value)->exists();
                    if ($user) {
                        $fail("Đã tồn tại tài khoản sử dụng $attribute này");
                    }
                }
            ],
            'username' => ['required', 'string', 'between:4,255', 'unique:users'],
            'password' => [
                'string',
                'required',
                'max:255'
            ]
        ];
    }
}
