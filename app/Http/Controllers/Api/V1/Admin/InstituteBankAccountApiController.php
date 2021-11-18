<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstituteBankAccountRequest;
use App\Http\Requests\UpdateInstituteBankAccountRequest;
use App\Http\Resources\Admin\InstituteBankAccountResource;
use App\Models\InstituteBankAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstituteBankAccountApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institute_bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteBankAccountResource(InstituteBankAccount::with(['banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin'])->get());
    }

    public function store(StoreInstituteBankAccountRequest $request)
    {
        $instituteBankAccount = InstituteBankAccount::create($request->all());

        return (new InstituteBankAccountResource($instituteBankAccount))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InstituteBankAccount $instituteBankAccount)
    {
        abort_if(Gate::denies('institute_bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstituteBankAccountResource($instituteBankAccount->load(['banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin']));
    }

    public function update(UpdateInstituteBankAccountRequest $request, InstituteBankAccount $instituteBankAccount)
    {
        $instituteBankAccount->update($request->all());

        return (new InstituteBankAccountResource($instituteBankAccount))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InstituteBankAccount $instituteBankAccount)
    {
        abort_if(Gate::denies('institute_bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteBankAccount->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
