<?php

namespace App\Http\Requests;

use App\Models\FinalSelection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinalSelectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('final_selection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:final_selections,id',
        ];
    }
}
