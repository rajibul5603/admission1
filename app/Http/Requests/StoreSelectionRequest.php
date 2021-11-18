<?php

namespace App\Http\Requests;

use App\Models\Selection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSelectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('selection_create');
    }

    public function rules()
    {
        return [
            'app_number' => [
                'string',
                'required',
                'unique:selections',
            ],
            'user' => [
                'string',
                'required',
                'unique:selections',
            ],
            'ih_comments' => [
                'string',
                'required',
            ],
            'ih_approval' => [
                'string',
                'required',
            ],
            'ih_submission' => [
                'string',
                'required',
            ],
            'useo_approval' => [
                'required',
            ],
            'useo_submission' => [
                'string',
                'required',
            ],
            'pmeat_comments' => [
                'string',
                'required',
            ],
            'pmeat_approval' => [
                'required',
            ],
            'eiin' => [
                'string',
                'required',
            ],
            'division' => [
                'string',
                'required',
            ],
            'district' => [
                'string',
                'required',
            ],
            'upazila' => [
                'string',
                'required',
            ],
        ];
    }
}
