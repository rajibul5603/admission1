<?php

namespace App\Http\Requests;

use App\Models\AcademicLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAcademicLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('academic_level_edit');
    }

    public function rules()
    {
        return [
            'level_name' => [
                'string',
                'max:100',
                'required',
                'unique:academic_levels,level_name,' . request()->route('academic_level')->id,
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
