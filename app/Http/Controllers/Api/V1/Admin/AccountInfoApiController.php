<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountInfoRequest;
use App\Http\Requests\UpdateAccountInfoRequest;
use App\Http\Resources\Admin\AccountInfoResource;
use App\Models\AccountInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountInfoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('account_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountInfoResource(AccountInfo::with(['app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code'])->get());
    }

    public function store(StoreAccountInfoRequest $request)
    {
        $accountInfo = AccountInfo::create($request->all());

        return (new AccountInfoResource($accountInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AccountInfo $accountInfo)
    {
        abort_if(Gate::denies('account_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AccountInfoResource($accountInfo->load(['app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code']));
    }

    public function update(UpdateAccountInfoRequest $request, AccountInfo $accountInfo)
    {
        $accountInfo->update($request->all());

        return (new AccountInfoResource($accountInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AccountInfo $accountInfo)
    {
        abort_if(Gate::denies('account_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
