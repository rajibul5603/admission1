<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class AccountInfoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('account_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AccountInfo::with(['app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code'])->select(sprintf('%s.*', (new AccountInfo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'account_info_show';
                $editGate = 'account_info_edit';
                $deleteGate = 'account_info_delete';
                $crudRoutePart = 'account-infos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('app_number_name', function ($row) {
                return $row->app_number ? $row->app_number->name : '';
            });

            $table->addColumn('banking_type_banking_type', function ($row) {
                return $row->banking_type ? $row->banking_type->banking_type : '';
            });

            $table->addColumn('bank_name_name', function ($row) {
                return $row->bank_name ? $row->bank_name->name : '';
            });

            $table->addColumn('bank_branch_branch_name', function ($row) {
                return $row->bank_branch ? $row->bank_branch->branch_name : '';
            });

            $table->editColumn('routing_no', function ($row) {
                return $row->routing_no ? $row->routing_no : '';
            });
            $table->editColumn('bank_account_owner', function ($row) {
                return $row->bank_account_owner ? AccountInfo::BANK_ACCOUNT_OWNER_SELECT[$row->bank_account_owner] : '';
            });
            $table->editColumn('acc_name', function ($row) {
                return $row->acc_name ? $row->acc_name : '';
            });
            $table->editColumn('acc_no', function ($row) {
                return $row->acc_no ? $row->acc_no : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'app_number', 'banking_type', 'bank_name', 'bank_branch']);

            return $table->make(true);
        }

        $general_infos             = GeneralInfo::get();
        $banking_types             = BankingType::get();
        $banking_service_providers = BankingServiceProvider::get();
        $districts                 = District::get();
        $bank_branches             = BankBranch::get();

        return view('admin.accountInfos.index', compact('general_infos', 'banking_types', 'banking_service_providers', 'districts', 'bank_branches'));
    }

    public function create()
    {
        abort_if(Gate::denies('account_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $app_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $banking_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_branches = BankBranch::pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branch_codes = BankBranch::pluck('branch_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.accountInfos.create', compact('app_numbers', 'banking_types', 'bank_names', 'districts', 'bank_branches', 'branch_codes'));
    }

    public function store(StoreAccountInfoRequest $request)
    {
        $accountInfo = AccountInfo::create($request->all());

        return redirect()->route('admin.account-infos.index');
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

        return view('admin.accountInfos.edit', compact('app_numbers', 'banking_types', 'bank_names', 'districts', 'bank_branches', 'branch_codes', 'accountInfo'));
    }

    public function update(UpdateAccountInfoRequest $request, AccountInfo $accountInfo)
    {
        $accountInfo->update($request->all());

        return redirect()->route('admin.account-infos.index');
    }

    public function show(AccountInfo $accountInfo)
    {
        abort_if(Gate::denies('account_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accountInfo->load('app_number', 'banking_type', 'bank_name', 'district', 'bank_branch', 'branch_code');

        return view('admin.accountInfos.show', compact('accountInfo'));
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
