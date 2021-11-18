<?php

namespace App\Http\Requests;

use App\Models\Disbursement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDisbursementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('disbursement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:disbursements,id',
        ];
    }
}
