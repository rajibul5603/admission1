<?php

namespace App\Http\Requests;

use App\Models\ApplicationTracking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyApplicationTrackingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('application_tracking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:application_trackings,id',
        ];
    }
}
