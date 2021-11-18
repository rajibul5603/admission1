<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankingServiceProviderRequest;
use App\Http\Requests\UpdateBankingServiceProviderRequest;
use App\Http\Resources\Admin\BankingServiceProviderResource;
use App\Models\BankingServiceProvider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankingServiceProviderApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('banking_service_provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankingServiceProviderResource(BankingServiceProvider::with(['bank_type'])->get());
    }

    public function store(StoreBankingServiceProviderRequest $request)
    {
        $bankingServiceProvider = BankingServiceProvider::create($request->all());

        return (new BankingServiceProviderResource($bankingServiceProvider))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankingServiceProviderResource($bankingServiceProvider->load(['bank_type']));
    }

    public function update(UpdateBankingServiceProviderRequest $request, BankingServiceProvider $bankingServiceProvider)
    {
        $bankingServiceProvider->update($request->all());

        return (new BankingServiceProviderResource($bankingServiceProvider))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingServiceProvider->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
