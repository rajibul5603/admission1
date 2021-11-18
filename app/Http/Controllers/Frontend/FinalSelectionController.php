<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFinalSelectionRequest;
use App\Http\Requests\StoreFinalSelectionRequest;
use App\Http\Requests\UpdateFinalSelectionRequest;
use App\Models\AcademicLevel;
use App\Models\District;
use App\Models\Division;
use App\Models\EducationalInstitute;
use App\Models\FinalSelection;
use App\Models\LevelWiseClass;
use App\Models\Selection;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalSelectionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('final_selection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelections = FinalSelection::with(['academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila'])->get();

        $academic_levels = AcademicLevel::get();

        $level_wise_classes = LevelWiseClass::get();

        $educational_institutes = EducationalInstitute::get();

        $selections = Selection::get();

        $divisions = Division::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        return view('frontend.finalSelections.index', compact('finalSelections', 'academic_levels', 'level_wise_classes', 'educational_institutes', 'selections', 'divisions', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('final_selection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_levels = AcademicLevel::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admission_classes = LevelWiseClass::pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education_institutes = EducationalInstitute::pluck('institution_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = Selection::pluck('eiin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.finalSelections.create', compact('academic_levels', 'admission_classes', 'education_institutes', 'eiins', 'divisions', 'districts', 'upazilas'));
    }

    public function store(StoreFinalSelectionRequest $request)
    {
        $finalSelection = FinalSelection::create($request->all());

        return redirect()->route('frontend.final-selections.index');
    }

    public function edit(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_levels = AcademicLevel::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admission_classes = LevelWiseClass::pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education_institutes = EducationalInstitute::pluck('institution_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = Selection::pluck('eiin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalSelection->load('academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila');

        return view('frontend.finalSelections.edit', compact('academic_levels', 'admission_classes', 'education_institutes', 'eiins', 'divisions', 'districts', 'upazilas', 'finalSelection'));
    }

    public function update(UpdateFinalSelectionRequest $request, FinalSelection $finalSelection)
    {
        $finalSelection->update($request->all());

        return redirect()->route('frontend.final-selections.index');
    }

    public function show(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelection->load('academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila');

        return view('frontend.finalSelections.show', compact('finalSelection'));
    }

    public function destroy(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelection->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinalSelectionRequest $request)
    {
        FinalSelection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
