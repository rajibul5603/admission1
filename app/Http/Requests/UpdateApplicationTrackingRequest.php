<?php

namespace App\Http\Requests;

use App\Models\ApplicationTracking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateApplicationTrackingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('application_tracking_edit');
    }

    public function rules()
    {
        return [
            'user_id_no_id' => [
                'required',
                'integer',
            ],
            'application_no' => [
                'string',
                'max:100',
                'required',
                'unique:application_trackings,application_no,' . request()->route('application_tracking')->id,
            ],
            'rejection_reaseon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
