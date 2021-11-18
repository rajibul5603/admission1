<?php

namespace App\Http\Requests;

use App\Models\FinalSelectionCriterion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinalSelectionCriterionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('final_selection_criterion_create');
    }

    public function rules()
    {
        return [
            'final_criteria_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'cirular_id' => [
                'required',
                'integer',
            ],
            'division_id' => [
                'required',
                'integer',
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'upazila_id' => [
                'required',
                'integer',
            ],
            'active' => [
                'required',
            ],
        ];
    }
}
