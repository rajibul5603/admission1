<?php

namespace App\Http\Requests;

use App\Models\Circular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCircularRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('circular_edit');
    }

    public function rules()
    {
        return [
            'circular_type' => [
                'required',
            ],
            'cirucular_name' => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:circulars,cirucular_name,' . request()->route('circular')->id,
            ],
            'circular_year' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'reference_number' => [
                'string',
                'min:5',
                'max:25',
                'required',
                'unique:circulars,reference_number,' . request()->route('circular')->id,
            ],
            'reference_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'academic_year_id' => [
                'required',
                'integer',
            ],
            'policy_id' => [
                'required',
                'integer',
            ],
            'sec_stipend_amount' => [
                'required',
            ],
            'hsec_stipend_amount' => [
                'required',
            ],
            'hons_stipend_amount' => [
                'required',
            ],
            'application_deadline' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'institution_head_deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'circular_status' => [
                'required',
            ],
        ];
    }
}
