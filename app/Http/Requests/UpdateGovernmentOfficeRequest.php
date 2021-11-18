<?php

namespace App\Http\Requests;

use App\Models\GovernmentOffice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGovernmentOfficeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('government_office_edit');
    }

    public function rules()
    {
        return [
            'govt_ogranization_name' => [
                'string',
                'required',
                'unique:government_offices,govt_ogranization_name,' . request()->route('government_office')->id,
            ],
        ];
    }
}
