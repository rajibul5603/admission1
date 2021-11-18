<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBankingServiceProviderRequest;
use App\Http\Requests\StoreBankingServiceProviderRequest;
use App\Http\Requests\UpdateBankingServiceProviderRequest;
use App\Models\BankingServiceProvider;
use App\Models\BankingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankingServiceProviderController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('banking_service_provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingServiceProviders = BankingServiceProvider::with(['bank_type'])->get();

        $banking_types = BankingType::get();

        return view('frontend.bankingServiceProviders.index', compact('bankingServiceProviders', 'banking_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('banking_service_provider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bankingServiceProviders.create', compact('bank_types'));
    }

    public function store(StoreBankingServiceProviderRequest $request)
    {
        $bankingServiceProvider = BankingServiceProvider::create($request->all());

        return redirect()->route('frontend.banking-service-providers.index');
    }

    public function edit(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankingServiceProvider->load('bank_type');

        return view('frontend.bankingServiceProviders.edit', compact('bank_types', 'bankingServiceProvider'));
    }

    public function update(UpdateBankingServiceProviderRequest $request, BankingServiceProvider $bankingServiceProvider)
    {
        $bankingServiceProvider->update($request->all());

        return redirect()->route('frontend.banking-service-providers.index');
    }

    public function show(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingServiceProvider->load('bank_type', 'bankNameBankBranches');

        return view('frontend.bankingServiceProviders.show', compact('bankingServiceProvider'));
    }

    public function destroy(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingServiceProvider->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankingServiceProviderRequest $request)
    {
        BankingServiceProvider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
