<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGovernmentOfficeRequest;
use App\Http\Requests\StoreGovernmentOfficeRequest;
use App\Http\Requests\UpdateGovernmentOfficeRequest;
use App\Models\GovernmentOffice;
use App\Models\MinistryDivision;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GovernmentOfficeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('government_office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GovernmentOffice::with(['ministry_name'])->select(sprintf('%s.*', (new GovernmentOffice())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'government_office_show';
                $editGate = 'government_office_edit';
                $deleteGate = 'government_office_delete';
                $crudRoutePart = 'government-offices';

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
            $table->addColumn('ministry_name_ministry_name', function ($row) {
                return $row->ministry_name ? $row->ministry_name->ministry_name : '';
            });

            $table->editColumn('ministry_name.division_name', function ($row) {
                return $row->ministry_name ? (is_string($row->ministry_name) ? $row->ministry_name : $row->ministry_name->division_name) : '';
            });
            $table->editColumn('govt_ogranization_name', function ($row) {
                return $row->govt_ogranization_name ? $row->govt_ogranization_name : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'ministry_name', 'active']);

            return $table->make(true);
        }

        $ministry_divisions = MinistryDivision::get();

        return view('admin.governmentOffices.index', compact('ministry_divisions'));
    }

    public function create()
    {
        abort_if(Gate::denies('government_office_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministry_names = MinistryDivision::all()->pluck('ministry_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.governmentOffices.create', compact('ministry_names'));
    }

    public function store(StoreGovernmentOfficeRequest $request)
    {
        $governmentOffice = GovernmentOffice::create($request->all());

        return redirect()->route('admin.government-offices.index');
    }

    public function edit(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministry_names = MinistryDivision::all()->pluck('ministry_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $governmentOffice->load('ministry_name');

        return view('admin.governmentOffices.edit', compact('ministry_names', 'governmentOffice'));
    }

    public function update(UpdateGovernmentOfficeRequest $request, GovernmentOffice $governmentOffice)
    {
        $governmentOffice->update($request->all());

        return redirect()->route('admin.government-offices.index');
    }

    public function show(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentOffice->load('ministry_name');

        return view('admin.governmentOffices.show', compact('governmentOffice'));
    }

    public function destroy(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentOffice->delete();

        return back();
    }

    public function massDestroy(MassDestroyGovernmentOfficeRequest $request)
    {
        GovernmentOffice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
