<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class InstituteBankAccountController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('institute_bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InstituteBankAccount::with(['banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin'])->select(sprintf('%s.*', (new InstituteBankAccount())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'institute_bank_account_show';
                $editGate = 'institute_bank_account_edit';
                $deleteGate = 'institute_bank_account_delete';
                $crudRoutePart = 'institute-bank-accounts';

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
            $table->addColumn('banking_type_banking_type', function ($row) {
                return $row->banking_type ? $row->banking_type->banking_type : '';
            });

            $table->editColumn('account_name', function ($row) {
                return $row->account_name ? $row->account_name : '';
            });
            $table->editColumn('account_number', function ($row) {
                return $row->account_number ? $row->account_number : '';
            });
            $table->addColumn('bank_name_name', function ($row) {
                return $row->bank_name ? $row->bank_name->name : '';
            });

            $table->addColumn('branch_name_branch_name', function ($row) {
                return $row->branch_name ? $row->branch_name->branch_name : '';
            });

            $table->addColumn('routing_no_routing_number', function ($row) {
                return $row->routing_no ? $row->routing_no->routing_number : '';
            });

            $table->addColumn('eiin_institution_eiin_no', function ($row) {
                return $row->eiin ? $row->eiin->institution_eiin_no : '';
            });

            $table->editColumn('eiin.institution_eiin_no', function ($row) {
                return $row->eiin ? (is_string($row->eiin) ? $row->eiin : $row->eiin->institution_eiin_no) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin']);

            return $table->make(true);
        }

        $banking_types             = BankingType::get();
        $banking_service_providers = BankingServiceProvider::get();
        $bank_branches             = BankBranch::get();
        $educational_institutes    = EducationalInstitute::get();

        return view('admin.instituteBankAccounts.index', compact('banking_types', 'banking_service_providers', 'bank_branches', 'educational_institutes'));
    }

    public function create()
    {
        abort_if(Gate::denies('institute_bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $banking_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $branch_names = BankBranch::pluck('branch_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $routing_nos = BankBranch::pluck('routing_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = EducationalInstitute::pluck('institution_eiin_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.instituteBankAccounts.create', compact('banking_types', 'bank_names', 'branch_names', 'routing_nos', 'eiins'));
    }

    public function store(StoreInstituteBankAccountRequest $request)
    {
        $instituteBankAccount = InstituteBankAccount::create($request->all());

        return redirect()->route('admin.institute-bank-accounts.index');
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

        return view('admin.instituteBankAccounts.edit', compact('banking_types', 'bank_names', 'branch_names', 'routing_nos', 'eiins', 'instituteBankAccount'));
    }

    public function update(UpdateInstituteBankAccountRequest $request, InstituteBankAccount $instituteBankAccount)
    {
        $instituteBankAccount->update($request->all());

        return redirect()->route('admin.institute-bank-accounts.index');
    }

    public function show(InstituteBankAccount $instituteBankAccount)
    {
        abort_if(Gate::denies('institute_bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instituteBankAccount->load('banking_type', 'bank_name', 'branch_name', 'routing_no', 'eiin');

        return view('admin.instituteBankAccounts.show', compact('instituteBankAccount'));
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
