<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'username' => [
                'string',
                'required',
                'unique:users,username,' . request()->route('user')->id,
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
