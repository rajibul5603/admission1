<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBankingTypeRequest;
use App\Http\Requests\StoreBankingTypeRequest;
use App\Http\Requests\UpdateBankingTypeRequest;
use App\Models\BankingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BankingTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('banking_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankingType::query()->select(sprintf('%s.*', (new BankingType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'banking_type_show';
                $editGate = 'banking_type_edit';
                $deleteGate = 'banking_type_delete';
                $crudRoutePart = 'banking-types';

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
            $table->editColumn('banking_type', function ($row) {
                return $row->banking_type ? $row->banking_type : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bankingTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('banking_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankingTypes.create');
    }

    public function store(StoreBankingTypeRequest $request)
    {
        $bankingType = BankingType::create($request->all());

        return redirect()->route('admin.banking-types.index');
    }

    public function edit(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankingTypes.edit', compact('bankingType'));
    }

    public function update(UpdateBankingTypeRequest $request, BankingType $bankingType)
    {
        $bankingType->update($request->all());

        return redirect()->route('admin.banking-types.index');
    }

    public function show(BankingType $bankingType)
    {
        abort_if(Gate::denies('banking_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankingTypes.show', compact('bankingType'));
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
