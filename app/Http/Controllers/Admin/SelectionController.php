<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySelectionRequest;
use App\Http\Requests\StoreSelectionRequest;
use App\Http\Requests\UpdateSelectionRequest;
use App\Models\Selection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SelectionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('selection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Selection::query()->select(sprintf('%s.*', (new Selection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'selection_show';
                $editGate = 'selection_edit';
                $deleteGate = 'selection_delete';
                $crudRoutePart = 'selections';

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
            $table->editColumn('app_number', function ($row) {
                return $row->app_number ? $row->app_number : '';
            });
            $table->editColumn('user', function ($row) {
                return $row->user ? $row->user : '';
            });
            $table->editColumn('ih_comments', function ($row) {
                return $row->ih_comments ? $row->ih_comments : '';
            });
            $table->editColumn('ih_approval', function ($row) {
                return $row->ih_approval ? $row->ih_approval : '';
            });
            $table->editColumn('ih_submission', function ($row) {
                return $row->ih_submission ? $row->ih_submission : '';
            });
            $table->editColumn('useo_approval', function ($row) {
                return $row->useo_approval ? Selection::USEO_APPROVAL_SELECT[$row->useo_approval] : '';
            });
            $table->editColumn('useo_submission', function ($row) {
                return $row->useo_submission ? $row->useo_submission : '';
            });
            $table->editColumn('pmeat_comments', function ($row) {
                return $row->pmeat_comments ? $row->pmeat_comments : '';
            });
            $table->editColumn('pmeat_approval', function ($row) {
                return $row->pmeat_approval ? Selection::PMEAT_APPROVAL_SELECT[$row->pmeat_approval] : '';
            });
            $table->editColumn('eiin', function ($row) {
                return $row->eiin ? $row->eiin : '';
            });
            $table->editColumn('division', function ($row) {
                return $row->division ? $row->division : '';
            });
            $table->editColumn('district', function ($row) {
                return $row->district ? $row->district : '';
            });
            $table->editColumn('upazila', function ($row) {
                return $row->upazila ? $row->upazila : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.selections.index');
    }

    public function create()
    {
        abort_if(Gate::denies('selection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.selections.create');
    }

    public function store(StoreSelectionRequest $request)
    {
        $selection = Selection::create($request->all());

        return redirect()->route('admin.selections.index');
    }

    public function edit(Selection $selection)
    {
        abort_if(Gate::denies('selection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.selections.edit', compact('selection'));
    }

    public function update(UpdateSelectionRequest $request, Selection $selection)
    {
        $selection->update($request->all());

        return redirect()->route('admin.selections.index');
    }

    public function show(Selection $selection)
    {
        abort_if(Gate::denies('selection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.selections.show', compact('selection'));
    }

    public function destroy(Selection $selection)
    {
        abort_if(Gate::denies('selection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $selection->delete();

        return back();
    }

    public function massDestroy(MassDestroySelectionRequest $request)
    {
        Selection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
