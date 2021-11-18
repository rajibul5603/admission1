<?php

namespace App\Http\Requests;

use App\Models\District;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDistrictRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('district_create');
    }

    public function rules()
    {
        return [
            'division_name_id' => [
                'required',
                'integer',
            ],
            'district_name' => [
                'string',
                'min:1',
                'max:100',
                'nullable',
            ],
            'district_name_en' => [
                'string',
                'min:10',
                'max:50',
                'nullable',
            ],
        ];
    }
}
