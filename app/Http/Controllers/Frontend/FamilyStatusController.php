<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFamilyStatusRequest;
use App\Http\Requests\StoreFamilyStatusRequest;
use App\Http\Requests\UpdateFamilyStatusRequest;
use App\Models\FamilyStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FamilyStatusController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('family_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyStatuses = FamilyStatus::all();

        return view('frontend.familyStatuses.index', compact('familyStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('family_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.familyStatuses.create');
    }

    public function store(StoreFamilyStatusRequest $request)
    {
        $familyStatus = FamilyStatus::create($request->all());

        return redirect()->route('frontend.family-statuses.index');
    }

    public function edit(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.familyStatuses.edit', compact('familyStatus'));
    }

    public function update(UpdateFamilyStatusRequest $request, FamilyStatus $familyStatus)
    {
        $familyStatus->update($request->all());

        return redirect()->route('frontend.family-statuses.index');
    }

    public function show(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.familyStatuses.show', compact('familyStatus'));
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
