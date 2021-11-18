<?php

namespace App\Http\Requests;

use App\Models\Division;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDivisionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('division_create');
    }

    public function rules()
    {
        return [
            'division_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
                'unique:divisions',
            ],
            'division_name_en' => [
                'string',
                'min:10',
                'max:50',
                'nullable',
            ],
        ];
    }
}
