<?php

namespace App\Http\Requests;

use App\Models\LevelWiseClass;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLevelWiseClassRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('level_wise_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:level_wise_classes,id',
        ];
    }
}
