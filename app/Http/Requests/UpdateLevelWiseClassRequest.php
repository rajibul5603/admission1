<?php

namespace App\Http\Requests;

use App\Models\LevelWiseClass;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLevelWiseClassRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('level_wise_class_edit');
    }

    public function rules()
    {
        return [
            'class_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
        ];
    }
}
