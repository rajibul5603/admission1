<?php

namespace App\Http\Requests;

use App\Models\FamilyStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFamilyStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('family_status_create');
    }

    public function rules()
    {
        return [
            'status_name' => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:family_statuses',
            ],
        ];
    }
}
