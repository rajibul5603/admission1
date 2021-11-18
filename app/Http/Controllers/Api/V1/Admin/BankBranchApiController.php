<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBankBranchRequest;
use App\Http\Requests\UpdateBankBranchRequest;
use App\Http\Resources\Admin\BankBranchResource;
use App\Models\BankBranch;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankBranchApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_branch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankBranchResource(BankBranch::with(['bank_name', 'district', 'upazila'])->get());
    }

    public function store(StoreBankBranchRequest $request)
    {
        $bankBranch = BankBranch::create($request->all());

        return (new BankBranchResource($bankBranch))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankBranchResource($bankBranch->load(['bank_name', 'district', 'upazila']));
    }

    public function update(UpdateBankBranchRequest $request, BankBranch $bankBranch)
    {
        $bankBranch->update($request->all());

        return (new BankBranchResource($bankBranch))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankBranch->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
