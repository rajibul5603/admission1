<?php

namespace App\Http\Requests;

use App\Models\BankBranch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankBranchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_branch_edit');
    }

    public function rules()
    {
        return [
            'bank_name_id' => [
                'required',
                'integer',
            ],
            'branch_name' => [
                'string',
                'max:100',
                'required',
            ],
            'branch_code' => [
                'string',
                'nullable',
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'routing_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:bank_branches,routing_number,' . request()->route('bank_branch')->id,
            ],
            'swift_code' => [
                'string',
                'max:15',
                'nullable',
            ],
            'manager_name' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'mobile' => [
                'string',
                'nullable',
            ],
        ];
    }
}
