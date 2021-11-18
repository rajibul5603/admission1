<?php

namespace App\Http\Requests;

use App\Models\GeneralInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGeneralInfoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('general_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:general_infos,id',
        ];
    }
}
