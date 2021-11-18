<?php

namespace App\Http\Requests;

use App\Models\MinistryDivision;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMinistryDivisionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ministry_division_edit');
    }

    public function rules()
    {
        return [
            'ministry_name' => [
                'string',
                'max:100',
                'required',
                'unique:ministry_divisions,ministry_name,' . request()->route('ministry_division')->id,
            ],
            'division_name' => [
                'string',
                'max:200',
                'nullable',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
