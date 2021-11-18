<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMinistryDivisionRequest;
use App\Http\Requests\StoreMinistryDivisionRequest;
use App\Http\Requests\UpdateMinistryDivisionRequest;
use App\Models\MinistryDivision;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinistryDivisionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('ministry_division_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministryDivisions = MinistryDivision::all();

        return view('frontend.ministryDivisions.index', compact('ministryDivisions'));
    }

    public function create()
    {
        abort_if(Gate::denies('ministry_division_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.ministryDivisions.create');
    }

    public function store(StoreMinistryDivisionRequest $request)
    {
        $ministryDivision = MinistryDivision::create($request->all());

        return redirect()->route('frontend.ministry-divisions.index');
    }

    public function edit(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.ministryDivisions.edit', compact('ministryDivision'));
    }

    public function update(UpdateMinistryDivisionRequest $request, MinistryDivision $ministryDivision)
    {
        $ministryDivision->update($request->all());

        return redirect()->route('frontend.ministry-divisions.index');
    }

    public function show(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.ministryDivisions.show', compact('ministryDivision'));
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
