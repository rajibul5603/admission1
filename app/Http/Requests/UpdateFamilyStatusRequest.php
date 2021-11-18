<?php

namespace App\Http\Requests;

use App\Models\FamilyStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFamilyStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('family_status_edit');
    }

    public function rules()
    {
        return [
            'status_name' => [
                'string',
                'min:1',
                'max:100',
                'required',
                'unique:family_statuses,status_name,' . request()->route('family_status')->id,
            ],
        ];
    }
}
