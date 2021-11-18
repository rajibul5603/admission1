<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyThanaRequest;
use App\Http\Requests\StoreThanaRequest;
use App\Http\Requests\UpdateThanaRequest;
use App\Models\District;
use App\Models\Thana;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ThanaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('thana_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Thana::with(['district_name'])->select(sprintf('%s.*', (new Thana())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'thana_show';
                $editGate = 'thana_edit';
                $deleteGate = 'thana_delete';
                $crudRoutePart = 'thanas';

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
            $table->addColumn('district_name_district_name', function ($row) {
                return $row->district_name ? $row->district_name->district_name : '';
            });

            $table->editColumn('thana_name', function ($row) {
                return $row->thana_name ? $row->thana_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'district_name']);

            return $table->make(true);
        }

        $districts = District::get();

        return view('admin.thanas.index', compact('districts'));
    }

    public function create()
    {
        abort_if(Gate::denies('thana_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district_names = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.thanas.create', compact('district_names'));
    }

    public function store(StoreThanaRequest $request)
    {
        $thana = Thana::create($request->all());

        return redirect()->route('admin.thanas.index');
    }

    public function edit(Thana $thana)
    {
        abort_if(Gate::denies('thana_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $district_names = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $thana->load('district_name');

        return view('admin.thanas.edit', compact('district_names', 'thana'));
    }

    public function update(UpdateThanaRequest $request, Thana $thana)
    {
        $thana->update($request->all());

        return redirect()->route('admin.thanas.index');
    }

    public function show(Thana $thana)
    {
        abort_if(Gate::denies('thana_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thana->load('district_name');

        return view('admin.thanas.show', compact('thana'));
    }

    public function destroy(Thana $thana)
    {
        abort_if(Gate::denies('thana_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thana->delete();

        return back();
    }

    public function massDestroy(MassDestroyThanaRequest $request)
    {
        Thana::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
