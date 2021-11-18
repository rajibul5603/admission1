<?php

namespace App\Http\Requests;

use App\Models\BankingServiceProvider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankingServiceProviderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banking_service_provider_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100',
                'required',
            ],
            'bank_type_id' => [
                'required',
                'integer',
            ],
            'head_office' => [
                'string',
                'nullable',
            ],
            'known_as' => [
                'string',
                'required',
            ],
            'swift_code' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
        ];
    }
}
