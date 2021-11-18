<?php

namespace App\Http\Requests;

use App\Models\BankingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('banking_type_edit');
    }

    public function rules()
    {
        return [
            'banking_type' => [
                'string',
                'min:1',
                'max:30',
                'nullable',
            ],
        ];
    }
}
