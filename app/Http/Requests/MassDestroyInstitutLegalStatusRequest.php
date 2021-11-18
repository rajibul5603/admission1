<?php

namespace App\Http\Requests;

use App\Models\InstitutLegalStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInstitutLegalStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('institut_legal_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:institut_legal_statuses,id',
        ];
    }
}
