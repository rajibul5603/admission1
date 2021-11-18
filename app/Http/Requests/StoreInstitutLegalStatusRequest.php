<?php

namespace App\Http\Requests;

use App\Models\InstitutLegalStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstitutLegalStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('institut_legal_status_create');
    }

    public function rules()
    {
        return [
            'institute_legal_status' => [
                'string',
                'min:1',
                'max:100',
                'nullable',
            ],
        ];
    }
}
