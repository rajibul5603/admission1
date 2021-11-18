<?php

namespace App\Http\Requests;

use App\Models\InstituteBankAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInstituteBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('institute_bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:institute_bank_accounts,id',
        ];
    }
}
