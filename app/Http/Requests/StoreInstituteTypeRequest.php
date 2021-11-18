<?php

namespace App\Http\Requests;

use App\Models\InstituteType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstituteTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_type_create');
    }

    public function rules()
    {
        return [
            'institute_type' => [
                'string',
                'max:100',
                'required',
                'unique:institute_types',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
