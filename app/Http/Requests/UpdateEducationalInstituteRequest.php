<?php

namespace App\Http\Requests;

use App\Models\EducationalInstitute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEducationalInstituteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('educational_institute_edit');
    }

    public function rules()
    {
        return [
            'institution_eiin_no' => [
                'string',
                'max:6',
                'required',
                'unique:educational_institutes,institution_eiin_no,' . request()->route('educational_institute')->id,
            ],
            'institution_name' => [
                'string',
                'max:200',
                'required',
            ],
            'institution_code' => [
                'string',
                'max:6',
                'nullable',
            ],
            'mpo_number' => [
                'string',
                'max:10',
                'nullable',
            ],
            'academic_levels.*' => [
                'integer',
            ],
            'academic_levels' => [
                'array',
            ],
            'disciplines.*' => [
                'integer',
            ],
            'disciplines' => [
                'array',
            ],
            'institute_head' => [
                'string',
                'min:1',
                'max:50',
                'nullable',
            ],
            'mobile_phone' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'phone' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'division_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
