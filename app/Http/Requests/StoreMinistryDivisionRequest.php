<?php

namespace App\Http\Requests;

use App\Models\MinistryDivision;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMinistryDivisionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ministry_division_create');
    }

    public function rules()
    {
        return [
            'ministry_name' => [
                'string',
                'max:100',
                'required',
                'unique:ministry_divisions',
            ],
            'division_name' => [
                'string',
                'max:200',
                'nullable',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
