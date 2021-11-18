<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankingTypeRequest;
use App\Http\Requests\UpdateBankingTypeRequest;
use App\Http\Resources\Admin\BankingTypeResource;
use App\Models\BankingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankingTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('banking_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankingTypeResource(BankingType::all());
    }

    public function store(StoreBankingTypeRequest $request)
    {
        $bankingType = BankingType::create($request->all());

        return (new BankingTypeResource($bankingType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankingTypeResource($bankingType);
    }

    public function update(UpdateBankingTypeRequest $request, BankingType $bankingType)
    {
        $bankingType->update($request->all());

        return (new BankingTypeResource($bankingType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
