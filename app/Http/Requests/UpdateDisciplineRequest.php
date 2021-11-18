<?php

namespace App\Http\Requests;

use App\Models\Discipline;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDisciplineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('discipline_edit');
    }

    public function rules()
    {
        return [
            'discipline_name' => [
                'string',
                'max:100',
                'required',
            ],
        ];
    }
}
