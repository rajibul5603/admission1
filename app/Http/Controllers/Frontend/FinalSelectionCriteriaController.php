<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFinalSelectionCriterionRequest;
use App\Http\Requests\StoreFinalSelectionCriterionRequest;
use App\Http\Requests\UpdateFinalSelectionCriterionRequest;
use App\Models\Circular;
use App\Models\District;
use App\Models\Division;
use App\Models\FinalSelectionCriterion;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalSelectionCriteriaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('final_selection_criterion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelectionCriteria = FinalSelectionCriterion::with(['cirular', 'division', 'district', 'upazila'])->get();

        $circulars = Circular::get();

        $divisions = Division::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        return view('frontend.finalSelectionCriteria.index', compact('finalSelectionCriteria', 'circulars', 'divisions', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('final_selection_criterion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cirulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.finalSelectionCriteria.create', compact('cirulars', 'divisions', 'districts', 'upazilas'));
    }

    public function store(StoreFinalSelectionCriterionRequest $request)
    {
        $finalSelectionCriterion = FinalSelectionCriterion::create($request->all());

        return redirect()->route('frontend.final-selection-criteria.index');
    }

    public function edit(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cirulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalSelectionCriterion->load('cirular', 'division', 'district', 'upazila');

        return view('frontend.finalSelectionCriteria.edit', compact('cirulars', 'divisions', 'districts', 'upazilas', 'finalSelectionCriterion'));
    }

    public function update(UpdateFinalSelectionCriterionRequest $request, FinalSelectionCriterion $finalSelectionCriterion)
    {
        $finalSelectionCriterion->update($request->all());

        return redirect()->route('frontend.final-selection-criteria.index');
    }

    public function show(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelectionCriterion->load('cirular', 'division', 'district', 'upazila');

        return view('frontend.finalSelectionCriteria.show', compact('finalSelectionCriterion'));
    }

    public function destroy(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelectionCriterion->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinalSelectionCriterionRequest $request)
    {
        FinalSelectionCriterion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
