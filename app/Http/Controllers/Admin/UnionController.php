<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUnionRequest;
use App\Http\Requests\StoreUnionRequest;
use App\Http\Requests\UpdateUnionRequest;
use App\Models\Union;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UnionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('union_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Union::with(['upazila'])->select(sprintf('%s.*', (new Union())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'union_show';
                $editGate = 'union_edit';
                $deleteGate = 'union_delete';
                $crudRoutePart = 'unions';

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
            $table->addColumn('upazila_upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->upazila_name : '';
            });

            $table->editColumn('union_name', function ($row) {
                return $row->union_name ? $row->union_name : '';
            });
            $table->editColumn('union_name_en', function ($row) {
                return $row->union_name_en ? $row->union_name_en : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'upazila']);

            return $table->make(true);
        }

        $upazilas = Upazila::get();

        return view('admin.unions.index', compact('upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('union_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.unions.create', compact('upazilas'));
    }

    public function store(StoreUnionRequest $request)
    {
        $union = Union::create($request->all());

        return redirect()->route('admin.unions.index');
    }

    public function edit(Union $union)
    {
        abort_if(Gate::denies('union_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $union->load('upazila');

        return view('admin.unions.edit', compact('upazilas', 'union'));
    }

    public function update(UpdateUnionRequest $request, Union $union)
    {
        $union->update($request->all());

        return redirect()->route('admin.unions.index');
    }

    public function show(Union $union)
    {
        abort_if(Gate::denies('union_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $union->load('upazila');

        return view('admin.unions.show', compact('union'));
    }

    public function destroy(Union $union)
    {
        abort_if(Gate::denies('union_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $union->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnionRequest $request)
    {
        Union::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
