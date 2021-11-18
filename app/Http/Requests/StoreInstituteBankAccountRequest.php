<?php

namespace App\Http\Requests;

use App\Models\InstituteBankAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstituteBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institute_bank_account_create');
    }

    public function rules()
    {
        return [
            'account_name' => [
                'string',
                'min:1',
                'max:100',
                'required',
            ],
            'account_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:institute_bank_accounts,account_number',
            ],
        ];
    }
}
