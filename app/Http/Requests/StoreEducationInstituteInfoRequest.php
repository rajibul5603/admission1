<?php

namespace App\Http\Requests;

use App\Models\EducationInstituteInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEducationInstituteInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('education_institute_info_create');
    }

    public function rules()
    {
        return [
            'application_number_id' => [
                'required',
                'integer',
            ],
            'institute_division' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'institute_district' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'institute_upazila' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'education_level_id' => [
                'required',
                'integer',
            ],
            'class_name_id' => [
                'required',
                'integer',
            ],
            'institute_name_id' => [
                'required',
                'integer',
            ],
            'eiin_id' => [
                'required',
                'integer',
            ],
            'last_study_class_id' => [
                'required',
                'integer',
            ],
            'last_gpa' => [
                'numeric',
                'required',
            ],
            'last_gpa_total' => [
                'numeric',
                'required',
            ],
            'user_id_no' => [
                'string',
                'required',
            ],
        ];
    }
}
