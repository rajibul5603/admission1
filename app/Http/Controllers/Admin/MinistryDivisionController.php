<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMinistryDivisionRequest;
use App\Http\Requests\StoreMinistryDivisionRequest;
use App\Http\Requests\UpdateMinistryDivisionRequest;
use App\Models\MinistryDivision;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MinistryDivisionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ministry_division_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MinistryDivision::query()->select(sprintf('%s.*', (new MinistryDivision())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ministry_division_show';
                $editGate = 'ministry_division_edit';
                $deleteGate = 'ministry_division_delete';
                $crudRoutePart = 'ministry-divisions';

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
            $table->editColumn('ministry_name', function ($row) {
                return $row->ministry_name ? $row->ministry_name : '';
            });
            $table->editColumn('division_name', function ($row) {
                return $row->division_name ? $row->division_name : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'active']);

            return $table->make(true);
        }

        return view('admin.ministryDivisions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ministry_division_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ministryDivisions.create');
    }

    public function store(StoreMinistryDivisionRequest $request)
    {
        $ministryDivision = MinistryDivision::create($request->all());

        return redirect()->route('admin.ministry-divisions.index');
    }

    public function edit(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ministryDivisions.edit', compact('ministryDivision'));
    }

    public function update(UpdateMinistryDivisionRequest $request, MinistryDivision $ministryDivision)
    {
        $ministryDivision->update($request->all());

        return redirect()->route('admin.ministry-divisions.index');
    }

    public function show(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ministryDivisions.show', compact('ministryDivision'));
    }

    public function destroy(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministryDivision->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinistryDivisionRequest $request)
    {
        MinistryDivision::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
