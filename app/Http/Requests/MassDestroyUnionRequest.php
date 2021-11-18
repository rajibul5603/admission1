<?php

namespace App\Http\Requests;

use App\Models\Union;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUnionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('union_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:unions,id',
        ];
    }
}
