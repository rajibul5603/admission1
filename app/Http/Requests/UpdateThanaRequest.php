<?php

namespace App\Http\Requests;

use App\Models\Thana;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateThanaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('thana_edit');
    }

    public function rules()
    {
        return [
            'district_name_id' => [
                'required',
                'integer',
            ],
            'thana_name'       => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:thanas,thana_name,' . request()->route('thana')->id,
            ],
        ];
    }
}
