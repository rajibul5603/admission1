<?php

namespace App\Http\Requests;

use App\Models\AcademicYear;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAcademicYearRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('academic_year_create');
    }

    public function rules()
    {
        return [
            'academic_year' => [
                'string',
                'min:9',
                'max:9',
                'required',
                'unique:academic_years',
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
