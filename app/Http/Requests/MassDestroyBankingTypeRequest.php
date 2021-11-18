<?php

namespace App\Http\Requests;

use App\Models\BankingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBankingTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('banking_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:banking_types,id',
        ];
    }
}
