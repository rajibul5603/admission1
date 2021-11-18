<?php

namespace App\Http\Requests;

use App\Models\FinalSelectionCriterion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinalSelectionCriterionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('final_selection_criterion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:final_selection_criteria,id',
        ];
    }
}
