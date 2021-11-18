<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstitutLegalStatusRequest;
use App\Http\Requests\StoreInstitutLegalStatusRequest;
use App\Http\Requests\UpdateInstitutLegalStatusRequest;
use App\Models\InstitutLegalStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InstitutLegalStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('institut_legal_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InstitutLegalStatus::query()->select(sprintf('%s.*', (new InstitutLegalStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'institut_legal_status_show';
                $editGate = 'institut_legal_status_edit';
                $deleteGate = 'institut_legal_status_delete';
                $crudRoutePart = 'institut-legal-statuses';

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
            $table->editColumn('institute_legal_status', function ($row) {
                return $row->institute_legal_status ? $row->institute_legal_status : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.institutLegalStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('institut_legal_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutLegalStatuses.create');
    }

    public function store(StoreInstitutLegalStatusRequest $request)
    {
        $institutLegalStatus = InstitutLegalStatus::create($request->all());

        return redirect()->route('admin.institut-legal-statuses.index');
    }

    public function edit(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutLegalStatuses.edit', compact('institutLegalStatus'));
    }

    public function update(UpdateInstitutLegalStatusRequest $request, InstitutLegalStatus $institutLegalStatus)
    {
        $institutLegalStatus->update($request->all());

        return redirect()->route('admin.institut-legal-statuses.index');
    }

    public function show(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.institutLegalStatuses.show', compact('institutLegalStatus'));
    }

    public function destroy(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutLegalStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstitutLegalStatusRequest $request)
    {
        InstitutLegalStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
