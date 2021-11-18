<?php

namespace App\Http\Requests;

use App\Models\Upazila;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUpazilaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('upazila_edit');
    }

    public function rules()
    {
        return [
            'upazila_name' => [
                'string',
                'min:10',
                'max:50',
                'nullable',
            ],
            'upazila_name_en' => [
                'string',
                'min:10',
                'max:50',
                'nullable',
            ],
        ];
    }
}
