<?php

namespace App\Http\Requests;

use App\Models\AccountInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAccountInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('account_info_edit');
    }

    public function rules()
    {
        return [
            'user' => [
                'string',
                'required',
                'unique:account_infos,user,' . request()->route('account_info')->id,
            ],
            'app_number_id' => [
                'required',
                'integer',
            ],
            'student_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'banking_type_id' => [
                'required',
                'integer',
            ],
            'bank_name_id' => [
                'required',
                'integer',
            ],
            'routing_no' => [
                'string',
                'max:15',
                'required',
                'unique:account_infos,routing_no,' . request()->route('account_info')->id,
            ],
            'bank_account_owner' => [
                'required',
            ],
            'acc_name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'acc_no' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'account_holder_nid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'eiin' => [
                'string',
                'nullable',
            ],
        ];
    }
}
