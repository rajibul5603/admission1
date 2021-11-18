<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGeneralInfoRequest;
use App\Http\Requests\StoreGeneralInfoRequest;
use App\Http\Requests\UpdateGeneralInfoRequest;
use App\Models\Circular;
use App\Models\District;
use App\Models\Division;
use App\Models\GeneralInfo;
use App\Models\Union;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralInfoController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('general_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generalInfos = GeneralInfo::with(['circular', 'division', 'district', 'upazila', 'union'])->get();

        $circulars = Circular::get();

        $divisions = Division::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        $unions = Union::get();

        return view('frontend.generalInfos.index', compact('generalInfos', 'circulars', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function create()
    {
        abort_if(Gate::denies('general_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.generalInfos.create', compact('circulars', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function store(StoreGeneralInfoRequest $request)
    {
        $generalInfo = GeneralInfo::create($request->all());

        return redirect()->route('frontend.general-infos.index');
    }

    public function edit(GeneralInfo $generalInfo)
    {
        abort_if(Gate::denies('general_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $generalInfo->load('circular', 'division', 'district', 'upazila', 'union');

        return view('frontend.generalInfos.edit', compact('circulars', 'divisions', 'districts', 'upazilas', 'unions', 'generalInfo'));
    }

    public function update(UpdateGeneralInfoRequest $request, GeneralInfo $generalInfo)
    {
        $generalInfo->update($request->all());

        return redirect()->route('frontend.general-infos.index');
    }

    public function show(GeneralInfo $generalInfo)
    {
        abort_if(Gate::denies('general_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generalInfo->load('circular', 'division', 'district', 'upazila', 'union', 'applicationNumberFamilyInfos', 'appNumberDocuments', 'applicationNumberEducationInstituteInfos', 'appNumberAccountInfos');

        return view('frontend.generalInfos.show', compact('generalInfo'));
    }

    public function destroy(GeneralInfo $generalInfo)
    {
        abort_if(Gate::denies('general_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generalInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyGeneralInfoRequest $request)
    {
        GeneralInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
