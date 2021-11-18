<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDistrictRequest;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\District;
use App\Models\Division;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('district_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = District::with(['division_name'])->select(sprintf('%s.*', (new District())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'district_show';
                $editGate = 'district_edit';
                $deleteGate = 'district_delete';
                $crudRoutePart = 'districts';

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
            $table->addColumn('division_name_division_name', function ($row) {
                return $row->division_name ? $row->division_name->division_name : '';
            });

            $table->editColumn('district_name', function ($row) {
                return $row->district_name ? $row->district_name : '';
            });
            $table->editColumn('district_name_en', function ($row) {
                return $row->district_name_en ? $row->district_name_en : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'division_name']);

            return $table->make(true);
        }

        $divisions = Division::get();

        return view('admin.districts.index', compact('divisions'));
    }

    public function create()
    {
        abort_if(Gate::denies('district_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division_names = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.districts.create', compact('division_names'));
    }

    public function store(StoreDistrictRequest $request)
    {
        $district = District::create($request->all());

        return redirect()->route('admin.districts.index');
    }

    public function edit(District $district)
    {
        abort_if(Gate::denies('district_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $division_names = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $district->load('division_name');

        return view('admin.districts.edit', compact('division_names', 'district'));
    }

    public function update(UpdateDistrictRequest $request, District $district)
    {
        $district->update($request->all());

        return redirect()->route('admin.districts.index');
    }

    public function show(District $district)
    {
        abort_if(Gate::denies('district_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district->load('division_name', 'districtNameThanas');

        return view('admin.districts.show', compact('district'));
    }

    public function destroy(District $district)
    {
        abort_if(Gate::denies('district_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district->delete();

        return back();
    }

    public function massDestroy(MassDestroyDistrictRequest $request)
    {
        District::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
