<?php

namespace App\Http\Requests;

use App\Models\Selection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySelectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('selection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:selections,id',
        ];
    }
}
