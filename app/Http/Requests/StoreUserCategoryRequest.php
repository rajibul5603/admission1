<?php

namespace App\Http\Requests;

use App\Models\UserCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_category_create');
    }

    public function rules()
    {
        return [
            'user_category' => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:user_categories',
            ],
        ];
    }
}
