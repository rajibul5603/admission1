<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySelectionRequest;
use App\Http\Requests\StoreSelectionRequest;
use App\Http\Requests\UpdateSelectionRequest;
use App\Models\Selection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SelectionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('selection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $selections = Selection::all();

        return view('frontend.selections.index', compact('selections'));
    }

    public function create()
    {
        abort_if(Gate::denies('selection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.selections.create');
    }

    public function store(StoreSelectionRequest $request)
    {
        $selection = Selection::create($request->all());

        return redirect()->route('frontend.selections.index');
    }

    public function edit(Selection $selection)
    {
        abort_if(Gate::denies('selection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.selections.edit', compact('selection'));
    }

    public function update(UpdateSelectionRequest $request, Selection $selection)
    {
        $selection->update($request->all());

        return redirect()->route('frontend.selections.index');
    }

    public function show(Selection $selection)
    {
        abort_if(Gate::denies('selection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.selections.show', compact('selection'));
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
