<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'username' => [
                'string',
                'required',
                'unique:users',
            ],
            'name' => [
                'string',
                'required',
            ],
            'guardian_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'brid' => [
                'string',
                'min:17',
                'max:17',
                'nullable',
            ],
            'eiin' => [
                'string',
                'min:6',
                'max:6',
                'nullable',
            ],
            'email' => [
                'required',
            ],
            'user_contact' => [
                'string',
                'nullable',
            ],
            'password' => [
                'required',
            ],
            'division_id' => [
                'required',
                'integer',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }
}
