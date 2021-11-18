<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFamilyStatusRequest;
use App\Http\Requests\StoreFamilyStatusRequest;
use App\Http\Requests\UpdateFamilyStatusRequest;
use App\Models\FamilyStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FamilyStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('family_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FamilyStatus::query()->select(sprintf('%s.*', (new FamilyStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'family_status_show';
                $editGate = 'family_status_edit';
                $deleteGate = 'family_status_delete';
                $crudRoutePart = 'family-statuses';

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
            $table->editColumn('status_name', function ($row) {
                return $row->status_name ? $row->status_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.familyStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('family_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.familyStatuses.create');
    }

    public function store(StoreFamilyStatusRequest $request)
    {
        $familyStatus = FamilyStatus::create($request->all());

        return redirect()->route('admin.family-statuses.index');
    }

    public function edit(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.familyStatuses.edit', compact('familyStatus'));
    }

    public function update(UpdateFamilyStatusRequest $request, FamilyStatus $familyStatus)
    {
        $familyStatus->update($request->all());

        return redirect()->route('admin.family-statuses.index');
    }

    public function show(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.familyStatuses.show', compact('familyStatus'));
    }

    public function destroy(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyFamilyStatusRequest $request)
    {
        FamilyStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
