<?php

namespace App\Http\Requests;

use App\Models\MinistryDivision;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMinistryDivisionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ministry_division_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ministry_divisions,id',
        ];
    }
}
