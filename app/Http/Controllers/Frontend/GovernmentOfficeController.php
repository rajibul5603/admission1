<?php

namespace App\Http\Controllers\Frontend;

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

class GovernmentOfficeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('government_office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentOffices = GovernmentOffice::with(['ministry_name'])->get();

        $ministry_divisions = MinistryDivision::get();

        return view('frontend.governmentOffices.index', compact('governmentOffices', 'ministry_divisions'));
    }

    public function create()
    {
        abort_if(Gate::denies('government_office_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministry_names = MinistryDivision::pluck('ministry_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.governmentOffices.create', compact('ministry_names'));
    }

    public function store(StoreGovernmentOfficeRequest $request)
    {
        $governmentOffice = GovernmentOffice::create($request->all());

        return redirect()->route('frontend.government-offices.index');
    }

    public function edit(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministry_names = MinistryDivision::pluck('ministry_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $governmentOffice->load('ministry_name');

        return view('frontend.governmentOffices.edit', compact('ministry_names', 'governmentOffice'));
    }

    public function update(UpdateGovernmentOfficeRequest $request, GovernmentOffice $governmentOffice)
    {
        $governmentOffice->update($request->all());

        return redirect()->route('frontend.government-offices.index');
    }

    public function show(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentOffice->load('ministry_name');

        return view('frontend.governmentOffices.show', compact('governmentOffice'));
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
