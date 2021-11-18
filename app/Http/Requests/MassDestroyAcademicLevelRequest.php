<?php

namespace App\Http\Requests;

use App\Models\AcademicLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAcademicLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('academic_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:academic_levels,id',
        ];
    }
}
