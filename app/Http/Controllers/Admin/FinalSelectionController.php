<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FinalSelectionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('final_selection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FinalSelection::with(['academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila'])->select(sprintf('%s.*', (new FinalSelection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'final_selection_show';
                $editGate = 'final_selection_edit';
                $deleteGate = 'final_selection_delete';
                $crudRoutePart = 'final-selections';

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
            $table->editColumn('app_number', function ($row) {
                return $row->app_number ? $row->app_number : '';
            });
            $table->editColumn('student_name', function ($row) {
                return $row->student_name ? $row->student_name : '';
            });
            $table->editColumn('brid', function ($row) {
                return $row->brid ? $row->brid : '';
            });
            $table->editColumn('father_name', function ($row) {
                return $row->father_name ? $row->father_name : '';
            });
            $table->editColumn('mother_name', function ($row) {
                return $row->mother_name ? $row->mother_name : '';
            });
            $table->addColumn('academic_level_level_name', function ($row) {
                return $row->academic_level ? $row->academic_level->level_name : '';
            });

            $table->addColumn('admission_class_class_name', function ($row) {
                return $row->admission_class ? $row->admission_class->class_name : '';
            });

            $table->addColumn('education_institute_institution_name', function ($row) {
                return $row->education_institute ? $row->education_institute->institution_name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'academic_level', 'admission_class', 'education_institute', 'division', 'district', 'upazila']);

            return $table->make(true);
        }

        $academic_levels        = AcademicLevel::get();
        $level_wise_classes     = LevelWiseClass::get();
        $educational_institutes = EducationalInstitute::get();
        $selections             = Selection::get();
        $divisions              = Division::get();
        $districts              = District::get();
        $upazilas               = Upazila::get();

        return view('admin.finalSelections.index', compact('academic_levels', 'level_wise_classes', 'educational_institutes', 'selections', 'divisions', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('final_selection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_levels = AcademicLevel::all()->pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admission_classes = LevelWiseClass::all()->pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education_institutes = EducationalInstitute::all()->pluck('institution_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = Selection::all()->pluck('eiin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::all()->pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::all()->pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.finalSelections.create', compact('academic_levels', 'admission_classes', 'education_institutes', 'eiins', 'divisions', 'districts', 'upazilas'));
    }

    public function store(StoreFinalSelectionRequest $request)
    {
        $finalSelection = FinalSelection::create($request->all());

        return redirect()->route('admin.final-selections.index');
    }

    public function edit(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_levels = AcademicLevel::all()->pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admission_classes = LevelWiseClass::all()->pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education_institutes = EducationalInstitute::all()->pluck('institution_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = Selection::all()->pluck('eiin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::all()->pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::all()->pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finalSelection->load('academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila');

        return view('admin.finalSelections.edit', compact('academic_levels', 'admission_classes', 'education_institutes', 'eiins', 'divisions', 'districts', 'upazilas', 'finalSelection'));
    }

    public function update(UpdateFinalSelectionRequest $request, FinalSelection $finalSelection)
    {
        $finalSelection->update($request->all());

        return redirect()->route('admin.final-selections.index');
    }

    public function show(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelection->load('academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila');

        return view('admin.finalSelections.show', compact('finalSelection'));
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
