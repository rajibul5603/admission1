<?php

namespace App\Http\Requests;

use App\Models\Policy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePolicyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('policy_edit');
    }

    public function rules()
    {
        return [
            'policy_name' => [
                'string',
                'max:200',
                'required',
            ],
            'policy_year' => [
                'required',
            ],
            'last_gpa' => [
                'numeric',
                'min:0',
                'max:5',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
