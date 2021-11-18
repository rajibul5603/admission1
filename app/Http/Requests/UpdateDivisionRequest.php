<?php

namespace App\Http\Requests;

use App\Models\Division;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDivisionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('division_edit');
    }

    public function rules()
    {
        return [
            'division_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
                'unique:divisions,division_name,' . request()->route('division')->id,
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
