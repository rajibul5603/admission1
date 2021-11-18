<?php

namespace App\Http\Requests;

use App\Models\FinalSelection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFinalSelectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('final_selection_edit');
    }

    public function rules()
    {
        return [
            'app_number' => [
                'string',
                'required',
            ],
            'user_id_no' => [
                'string',
                'max:30',
                'required',
            ],
            'student_name' => [
                'string',
                'max:100',
                'required',
            ],
            'brid' => [
                'string',
                'required',
            ],
            'father_name' => [
                'string',
                'max:100',
                'required',
            ],
            'father_nid' => [
                'string',
                'max:100',
                'required',
            ],
            'mother_name' => [
                'string',
                'max:100',
                'required',
            ],
            'mother_nid' => [
                'string',
                'max:30',
                'required',
            ],
            'academic_level_id' => [
                'required',
                'integer',
            ],
            'admission_class_id' => [
                'required',
                'integer',
            ],
            'eiin_id' => [
                'required',
                'integer',
            ],
            'division_id' => [
                'required',
                'integer',
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'upazila_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
