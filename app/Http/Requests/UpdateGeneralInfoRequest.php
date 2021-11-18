<?php

namespace App\Http\Requests;

use App\Models\GeneralInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGeneralInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('general_info_edit');
    }

    public function rules()
    {
        return [
            'user_id_no' => [
                'string',
                'max:100',
                'required',
            ],
            'application_no' => [
                'string',
                'min:1',
                'max:25',
                'required',
                'unique:general_infos,application_no,' . request()->route('general_info')->id,
            ],
            'grants_name' => [
                'string',
                'required',
            ],
            'circular_id' => [
                'required',
                'integer',
            ],
            'brid' => [
                'string',
                'min:17',
                'max:17',
                'required',
                'unique:general_infos,brid,' . request()->route('general_info')->id,
            ],
            'nid' => [
                'string',
                'min:10',
                'max:17',
                'nullable',
            ],
            'name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'father_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'father_nid' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mother_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'mother_nid' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'age' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
            'union_id' => [
                'required',
                'integer',
            ],
            'village' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
        ];
    }
}
