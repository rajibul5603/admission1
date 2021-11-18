<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BankingServiceProviderController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('banking_service_provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankingServiceProvider::with(['bank_type'])->select(sprintf('%s.*', (new BankingServiceProvider())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'banking_service_provider_show';
                $editGate = 'banking_service_provider_edit';
                $deleteGate = 'banking_service_provider_delete';
                $crudRoutePart = 'banking-service-providers';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('bank_type_banking_type', function ($row) {
                return $row->bank_type ? $row->bank_type->banking_type : '';
            });

            $table->editColumn('head_office', function ($row) {
                return $row->head_office ? $row->head_office : '';
            });
            $table->editColumn('known_as', function ($row) {
                return $row->known_as ? $row->known_as : '';
            });
            $table->editColumn('swift_code', function ($row) {
                return $row->swift_code ? $row->swift_code : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->category ? BankingServiceProvider::CATEGORY_SELECT[$row->category] : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bank_type']);

            return $table->make(true);
        }

        $banking_types = BankingType::get();

        return view('admin.bankingServiceProviders.index', compact('banking_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('banking_service_provider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bankingServiceProviders.create', compact('bank_types'));
    }

    public function store(StoreBankingServiceProviderRequest $request)
    {
        $bankingServiceProvider = BankingServiceProvider::create($request->all());

        return redirect()->route('admin.banking-service-providers.index');
    }

    public function edit(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_types = BankingType::pluck('banking_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankingServiceProvider->load('bank_type');

        return view('admin.bankingServiceProviders.edit', compact('bank_types', 'bankingServiceProvider'));
    }

    public function update(UpdateBankingServiceProviderRequest $request, BankingServiceProvider $bankingServiceProvider)
    {
        $bankingServiceProvider->update($request->all());

        return redirect()->route('admin.banking-service-providers.index');
    }

    public function show(BankingServiceProvider $bankingServiceProvider)
    {
        abort_if(Gate::denies('banking_service_provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankingServiceProvider->load('bank_type', 'bankNameBankBranches');

        return view('admin.bankingServiceProviders.show', compact('bankingServiceProvider'));
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
