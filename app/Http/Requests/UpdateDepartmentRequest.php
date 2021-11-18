<?php

namespace App\Http\Requests;

use App\Models\Department;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('department_edit');
    }

    public function rules()
    {
        return [
            'department_name' => [
                'string',
                'min:10',
                'max:150',
                'required',
                'unique:departments,department_name,' . request()->route('department')->id,
            ],
        ];
    }
}
