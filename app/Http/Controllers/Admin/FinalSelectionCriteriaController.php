<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FinalSelectionCriteriaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('final_selection_criterion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FinalSelectionCriterion::with(['cirular', 'division', 'district', 'upazila'])->select(sprintf('%s.*', (new FinalSelectionCriterion())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'final_selection_criterion_show';
                $editGate = 'final_selection_criterion_edit';
                $deleteGate = 'final_selection_criterion_delete';
                $crudRoutePart = 'final-selection-criteria';

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
            $table->editColumn('final_criteria_name', function ($row) {
                return $row->final_criteria_name ? $row->final_criteria_name : '';
            });
            $table->addColumn('cirular_cirucular_name', function ($row) {
                return $row->cirular ? $row->cirular->cirucular_name : '';
            });

            $table->addColumn('division_division_name', function ($row) {
                return $row->division ? $row->division->division_name : '';
            });

            $table->addColumn('district_district_name', function ($row) {
                return $row->district ? $row->district->district_name : '';
            });

            $table->addColumn('upazila_upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->upazila_name : '';
            });

            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'cirular', 'division', 'district', 'upazila', 'active']);

            return $table->make(true);
        }

        $circulars = Circular::get();
        $divisions = Division::get();
        $districts = District::get();
        $upazilas  = Upazila::get();

        return view('admin.finalSelectionCriteria.index', compact('circulars', 'divisions', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('final_selection_criterion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cirulars = Circular::all()->pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::all()->pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::all()->pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.finalSelectionCriteria.create', compact('cirulars', 'divisions', 'districts', 'upazilas'));
    }

    public function store(StoreFinalSelectionCriterionRequest $request)
    {
        $finalSelectionCriterion = FinalSelectionCriterion::create($request->all());

        return redirect()->route('admin.final-selection-criteria.index');
    }

    public function edit(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cirulars = Circular::all()->pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::all()->pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::all()->pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalSelectionCriterion->load('cirular', 'division', 'district', 'upazila');

        return view('admin.finalSelectionCriteria.edit', compact('cirulars', 'divisions', 'districts', 'upazilas', 'finalSelectionCriterion'));
    }

    public function update(UpdateFinalSelectionCriterionRequest $request, FinalSelectionCriterion $finalSelectionCriterion)
    {
        $finalSelectionCriterion->update($request->all());

        return redirect()->route('admin.final-selection-criteria.index');
    }

    public function show(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelectionCriterion->load('cirular', 'division', 'district', 'upazila');

        return view('admin.finalSelectionCriteria.show', compact('finalSelectionCriterion'));
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
