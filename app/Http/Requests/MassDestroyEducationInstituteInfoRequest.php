<?php

namespace App\Http\Requests;

use App\Models\EducationInstituteInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEducationInstituteInfoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('education_institute_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:education_institute_infos,id',
        ];
    }
}
