<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAccountInfoRequest;
use App\Http\Requests\StoreAccountInfoRequest;
use App\Http\Requests\UpdateAccountInfoRequest;
use App\Models\AccountInfo;
use App\Models\BankBranch;
use App\Models\BankingServiceProvider;
use App\Models\BankingType;
use App\Models\District;
use App\Models\GeneralInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountInfoController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('account_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountInfos = AccountInfo::with(['app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code'])->get();

        $general_infos = GeneralInfo::get();

        $banking_types = BankingType::get();

        $banking_service_providers = BankingServiceProvider::get();

        $districts = District::get();

        $bank_branches = BankBranch::get();

        return view('frontend.accountInfos.index', compact('accountInfos', 'general_infos', 'banking_types', 'banking_service_providers', 'districts', 'bank_branches'));
    }

    public function create()
    {
        abort_if(Gate::denies('account_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $app_numbers = GeneralInfo::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $banking_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_branches = BankBranch::pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branch_codes = BankBranch::pluck('branch_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.accountInfos.create', compact('app_numbers', 'banking_types', 'bank_names', 'districts', 'bank_branches', 'branch_codes'));
    }

    public function store(StoreAccountInfoRequest $request)
    {
        $accountInfo = AccountInfo::create($request->all());

        return redirect()->route('frontend.account-infos.index');
    }

    public function edit(AccountInfo $accountInfo)
    {
        abort_if(Gate::denies('account_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $app_numbers = GeneralInfo::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $banking_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_branches = BankBranch::pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branch_codes = BankBranch::pluck('branch_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accountInfo->load('app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code');

        return view('frontend.accountInfos.edit', compact('app_numbers', 'banking_types', 'bank_names', 'districts', 'bank_branches', 'branch_codes', 'accountInfo'));
    }

    public function update(UpdateAccountInfoRequest $request, AccountInfo $accountInfo)
    {
        $accountInfo->update($request->all());

        return redirect()->route('frontend.account-infos.index');
    }

    public function show(AccountInfo $accountInfo)
    {
        abort_if(Gate::denies('account_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountInfo->load('app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code');

        return view('frontend.accountInfos.show', compact('accountInfo'));
    }

    public function destroy(AccountInfo $accountInfo)
    {
        abort_if(Gate::denies('account_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccountInfoRequest $request)
    {
        AccountInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
