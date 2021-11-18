<?php

namespace App\Http\Requests;

use App\Models\AcademicYear;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAcademicYearRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('academic_year_edit');
    }

    public function rules()
    {
        return [
            'academic_year' => [
                'string',
                'min:9',
                'max:9',
                'required',
                'unique:academic_years,academic_year,' . request()->route('academic_year')->id,
            ],
            'start_year' => [
                'string',
                'min:4',
                'max:4',
                'nullable',
            ],
            'end_year' => [
                'string',
                'min:4',
                'max:4',
                'nullable',
            ],
        ];
    }
}
