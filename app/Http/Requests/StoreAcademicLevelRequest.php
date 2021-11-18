<?php

namespace App\Http\Requests;

use App\Models\AcademicLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAcademicLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('academic_level_create');
    }

    public function rules()
    {
        return [
            'level_name' => [
                'string',
                'max:100',
                'required',
                'unique:academic_levels',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
