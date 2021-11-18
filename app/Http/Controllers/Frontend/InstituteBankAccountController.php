<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInstituteBankAccountRequest;
use App\Http\Requests\StoreInstituteBankAccountRequest;
use App\Http\Requests\UpdateInstituteBankAccountRequest;
use App\Models\BankBranch;
use App\Models\BankingServiceProvider;
use App\Models\BankingType;
use App\Models\EducationalInstitute;
use App\Models\InstituteBankAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstituteBankAccountController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institute_bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteBankAccounts = InstituteBankAccount::with(['banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin'])->get();

        $banking_types = BankingType::get();

        $banking_service_providers = BankingServiceProvider::get();

        $bank_branches = BankBranch::get();

        $educational_institutes = EducationalInstitute::get();

        return view('frontend.instituteBankAccounts.index', compact('instituteBankAccounts', 'banking_types', 'banking_service_providers', 'bank_branches', 'educational_institutes'));
    }

    public function create()
    {
        abort_if(Gate::denies('institute_bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banking_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branch_names = BankBranch::pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routing_nos = BankBranch::pluck('routing_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = EducationalInstitute::pluck('institution_eiin_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.instituteBankAccounts.create', compact('banking_types', 'bank_names', 'branch_names', 'routing_nos', 'eiins'));
    }

    public function store(StoreInstituteBankAccountRequest $request)
    {
        $instituteBankAccount = InstituteBankAccount::create($request->all());

        return redirect()->route('frontend.institute-bank-accounts.index');
    }

    public function edit(InstituteBankAccount $instituteBankAccount)
    {
        abort_if(Gate::denies('institute_bank_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banking_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branch_names = BankBranch::pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routing_nos = BankBranch::pluck('routing_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = EducationalInstitute::pluck('institution_eiin_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instituteBankAccount->load('banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin');

        return view('frontend.instituteBankAccounts.edit', compact('banking_types', 'bank_names', 'branch_names', 'routing_nos', 'eiins', 'instituteBankAccount'));
    }

    public function update(UpdateInstituteBankAccountRequest $request, InstituteBankAccount $instituteBankAccount)
    {
        $instituteBankAccount->update($request->all());

        return redirect()->route('frontend.institute-bank-accounts.index');
    }

    public function show(InstituteBankAccount $instituteBankAccount)
    {
        abort_if(Gate::denies('institute_bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteBankAccount->load('banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin');

        return view('frontend.instituteBankAccounts.show', compact('instituteBankAccount'));
    }

    public function destroy(InstituteBankAccount $instituteBankAccount)
    {
        abort_if(Gate::denies('institute_bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteBankAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstituteBankAccountRequest $request)
    {
        InstituteBankAccount::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
