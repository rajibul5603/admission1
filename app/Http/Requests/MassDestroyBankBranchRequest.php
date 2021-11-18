<?php

namespace App\Http\Requests;

use App\Models\BankBranch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBankBranchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bank_branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bank_branches,id',
        ];
    }
}
