<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEducationalInstituteRequest;
use App\Http\Requests\StoreEducationalInstituteRequest;
use App\Http\Requests\UpdateEducationalInstituteRequest;
use App\Models\AcademicLevel;
use App\Models\Discipline;
use App\Models\District;
use App\Models\Division;
use App\Models\EducationalInstitute;
use App\Models\InstitutLegalStatus;
use App\Models\Union;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationalInstituteController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('educational_institute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalInstitutes = EducationalInstitute::with(['legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union'])->get();

        $institut_legal_statuses = InstitutLegalStatus::get();

        $academic_levels = AcademicLevel::get();

        $disciplines = Discipline::get();

        $divisions = Division::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        $unions = Union::get();

        return view('frontend.educationalInstitutes.index', compact('educationalInstitutes', 'institut_legal_statuses', 'academic_levels', 'disciplines', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function create()
    {
        abort_if(Gate::denies('educational_institute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legal_statuses = InstitutLegalStatus::pluck('institute_legal_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academic_levels = AcademicLevel::pluck('level_name', 'id');

        $disciplines = Discipline::pluck('discipline_name', 'id');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.educationalInstitutes.create', compact('legal_statuses', 'academic_levels', 'disciplines', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function store(StoreEducationalInstituteRequest $request)
    {
        $educationalInstitute = EducationalInstitute::create($request->all());
        $educationalInstitute->academic_levels()->sync($request->input('academic_levels', []));
        $educationalInstitute->disciplines()->sync($request->input('disciplines', []));

        return redirect()->route('frontend.educational-institutes.index');
    }

    public function edit(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legal_statuses = InstitutLegalStatus::pluck('institute_legal_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academic_levels = AcademicLevel::pluck('level_name', 'id');

        $disciplines = Discipline::pluck('discipline_name', 'id');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $educationalInstitute->load('legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union');

        return view('frontend.educationalInstitutes.edit', compact('legal_statuses', 'academic_levels', 'disciplines', 'divisions', 'districts', 'upazilas', 'unions', 'educationalInstitute'));
    }

    public function update(UpdateEducationalInstituteRequest $request, EducationalInstitute $educationalInstitute)
    {
        $educationalInstitute->update($request->all());
        $educationalInstitute->academic_levels()->sync($request->input('academic_levels', []));
        $educationalInstitute->disciplines()->sync($request->input('disciplines', []));

        return redirect()->route('frontend.educational-institutes.index');
    }

    public function show(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalInstitute->load('legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union', 'eiinInstituteBankAccounts');

        return view('frontend.educationalInstitutes.show', compact('educationalInstitute'));
    }

    public function destroy(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalInstitute->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationalInstituteRequest $request)
    {
        EducationalInstitute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
