<?php

namespace App\Http\Requests;

use App\Models\Union;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUnionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('union_create');
    }

    public function rules()
    {
        return [
            'union_name' => [
                'string',
                'min:10',
                'max:50',
                'required',
            ],
            'union_name_en' => [
                'string',
                'min:10',
                'max:50',
                'nullable',
            ],
        ];
    }
}
