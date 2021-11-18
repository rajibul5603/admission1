<?php

namespace App\Http\Requests;

use App\Models\Thana;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreThanaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('thana_create');
    }

    public function rules()
    {
        return [
            'district_name_id' => [
                'required',
                'integer',
            ],
            'thana_name'       => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:thanas',
            ],
        ];
    }
}
