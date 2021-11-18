<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBankingTypeRequest;
use App\Http\Requests\StoreBankingTypeRequest;
use App\Http\Requests\UpdateBankingTypeRequest;
use App\Models\BankingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankingTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('banking_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingTypes = BankingType::all();

        return view('frontend.bankingTypes.index', compact('bankingTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('banking_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bankingTypes.create');
    }

    public function store(StoreBankingTypeRequest $request)
    {
        $bankingType = BankingType::create($request->all());

        return redirect()->route('frontend.banking-types.index');
    }

    public function edit(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bankingTypes.edit', compact('bankingType'));
    }

    public function update(UpdateBankingTypeRequest $request, BankingType $bankingType)
    {
        $bankingType->update($request->all());

        return redirect()->route('frontend.banking-types.index');
    }

    public function show(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bankingTypes.show', compact('bankingType'));
    }

    public function destroy(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankingTypeRequest $request)
    {
        BankingType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
