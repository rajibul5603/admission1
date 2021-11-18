<?php

namespace App\Http\Requests;

use App\Models\GovernmentOffice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGovernmentOfficeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('government_office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:government_offices,id',
        ];
    }
}
