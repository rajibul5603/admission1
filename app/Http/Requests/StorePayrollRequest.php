<?php

namespace App\Http\Requests;

use App\Models\Payroll;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePayrollRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payroll_create');
    }

    public function rules()
    {
        return [
            'payroll_name' => [
                'string',
                'required',
            ],
            'circular_id' => [
                'required',
                'integer',
            ],
            'total_student' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'financial_institutaion' => [
                'string',
                'nullable',
            ],
            'disbursement_status' => [
                'required',
            ],
            'activation_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'deactivation_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'api_key' => [
                'string',
                'nullable',
            ],
        ];
    }
}
