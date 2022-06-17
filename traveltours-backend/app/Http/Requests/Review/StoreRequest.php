<?php

namespace App\Http\Requests\Review;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:255',
            'user_id' => 'required|numeric|exists:users,id',
            'star' => 'required|numeric',
            'type' => 'required|in:place,tour',
            'object_id' => ['required', function($attr, $value, $fail){
                if($this->type == 'place'){
                    $cond = \App\Models\Place::query()->find($value)->exists();
                    if(!$cond){
                        $fail($attr . " have type place not exists");
                    }
                } else if ($this->type == 'tour'){
                    $cond = \App\Models\Tour::query()->find($value)->exists();
                    if(!$cond){
                        $fail($attr . " have type place not exists");
                    }
                }
            }]
        ];
    }
}
