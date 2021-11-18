<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFamilyInfoRequest;
use App\Http\Requests\StoreFamilyInfoRequest;
use App\Http\Requests\UpdateFamilyInfoRequest;
use App\Models\FamilyInfo;
use App\Models\FamilyStatus;
use App\Models\GeneralInfo;
use App\Models\Occupation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FamilyInfoController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('family_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyInfos = FamilyInfo::with(['application_number', 'familystatus', 'guardian_occupation'])->get();

        $general_infos = GeneralInfo::get();

        $family_statuses = FamilyStatus::get();

        $occupations = Occupation::get();

        return view('frontend.familyInfos.index', compact('familyInfos', 'general_infos', 'family_statuses', 'occupations'));
    }

    public function create()
    {
        abort_if(Gate::denies('family_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $familystatuses = FamilyStatus::pluck('status_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guardian_occupations = Occupation::pluck('occupation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.familyInfos.create', compact('application_numbers', 'familystatuses', 'guardian_occupations'));
    }

    public function store(StoreFamilyInfoRequest $request)
    {
        $familyInfo = FamilyInfo::create($request->all());

        return redirect()->route('frontend.family-infos.index');
    }

    public function edit(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $familystatuses = FamilyStatus::pluck('status_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guardian_occupations = Occupation::pluck('occupation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $familyInfo->load('application_number', 'familystatus', 'guardian_occupation');

        return view('frontend.familyInfos.edit', compact('application_numbers', 'familystatuses', 'guardian_occupations', 'familyInfo'));
    }

    public function update(UpdateFamilyInfoRequest $request, FamilyInfo $familyInfo)
    {
        $familyInfo->update($request->all());

        return redirect()->route('frontend.family-infos.index');
    }

    public function show(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyInfo->load('application_number', 'familystatus', 'guardian_occupation');

        return view('frontend.familyInfos.show', compact('familyInfo'));
    }

    public function destroy(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyFamilyInfoRequest $request)
    {
        FamilyInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
