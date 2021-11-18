<?php

namespace App\Http\Requests;

use App\Models\FamilyInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFamilyInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('family_info_create');
    }

    public function rules()
    {
        return [
            'user_id_no' => [
                'string',
                'required',
            ],
            'application_number_id' => [
                'required',
                'integer',
            ],
            'familystatus_id' => [
                'required',
                'integer',
            ],
            'guardian_occupation_id' => [
                'required',
                'integer',
            ],
            'guardian_education' => [
                'required',
            ],
            'guardian_land' => [
                'numeric',
                'required',
                'max:100',
            ],
            'guardian_annual_income' => [
                'required',
            ],
            'family_member' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
