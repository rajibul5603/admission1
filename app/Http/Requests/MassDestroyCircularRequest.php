<?php

namespace App\Http\Requests;

use App\Models\Circular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCircularRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('circular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:circulars,id',
        ];
    }
}
