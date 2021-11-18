<?php

namespace App\Http\Requests;

use App\Models\PaymentHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_history_create');
    }

    public function rules()
    {
        return [
            'app_number' => [
                'string',
                'required',
            ],
            'stu_name' => [
                'string',
                'required',
            ],
            'brid' => [
                'string',
                'max:50',
                'required',
            ],
            'bank_acc_no' => [
                'string',
                'required',
            ],
            'bank_acc_name' => [
                'string',
                'required',
            ],
            'student_bank_name' => [
                'string',
                'required',
            ],
            'student_bank_branch' => [
                'string',
                'required',
            ],
            'bank_routing_no' => [
                'string',
                'required',
            ],
            'student_division' => [
                'string',
                'required',
            ],
            'student_district' => [
                'string',
                'required',
            ],
            'student_upazila' => [
                'string',
                'required',
            ],
            'pay_amount' => [
                'numeric',
                'required',
            ],
            'service_provider' => [
                'string',
                'required',
            ],
            'disbursement_amount' => [
                'numeric',
                'required',
            ],
            'disbursement_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'disbursement_status' => [
                'required',
            ],
        ];
    }
}
