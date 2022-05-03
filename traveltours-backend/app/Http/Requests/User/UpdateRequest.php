<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id' => 'required|numeric',
            'name' => 'required|max:255',
            'email' => ['required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $user = User::query()
                        ->where('email', $value)
                        ->where('id', '<>', $this->id)
                        ->exists();
                    if ($user) {
                        $fail("Đã tồn tại tài khoản sử dụng email này");
                    }
                }
            ]
        ];
    }
}
