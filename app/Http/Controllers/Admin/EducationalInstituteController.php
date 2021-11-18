<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class EducationalInstituteController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('educational_institute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EducationalInstitute::with(['legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union'])->select(sprintf('%s.*', (new EducationalInstitute())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'educational_institute_show';
                $editGate = 'educational_institute_edit';
                $deleteGate = 'educational_institute_delete';
                $crudRoutePart = 'educational-institutes';

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
            $table->editColumn('institution_eiin_no', function ($row) {
                return $row->institution_eiin_no ? $row->institution_eiin_no : '';
            });
            $table->editColumn('institution_name', function ($row) {
                return $row->institution_name ? $row->institution_name : '';
            });
            $table->addColumn('legal_status_institute_legal_status', function ($row) {
                return $row->legal_status ? $row->legal_status->institute_legal_status : '';
            });

            $table->editColumn('academic_level', function ($row) {
                $labels = [];
                foreach ($row->academic_levels as $academic_level) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $academic_level->level_name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('institute_head', function ($row) {
                return $row->institute_head ? $row->institute_head : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('mobile_phone', function ($row) {
                return $row->mobile_phone ? $row->mobile_phone : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
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

            $table->addColumn('union_union_name', function ($row) {
                return $row->union ? $row->union->union_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'legal_status', 'academic_level', 'division', 'district', 'upazila', 'union']);

            return $table->make(true);
        }

        $institut_legal_statuses = InstitutLegalStatus::get();
        $academic_levels         = AcademicLevel::get();
        $disciplines             = Discipline::get();
        $divisions               = Division::get();
        $districts               = District::get();
        $upazilas                = Upazila::get();
        $unions                  = Union::get();

        return view('admin.educationalInstitutes.index', compact('institut_legal_statuses', 'academic_levels', 'disciplines', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function create()
    {
        abort_if(Gate::denies('educational_institute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legal_statuses = InstitutLegalStatus::all()->pluck('institute_legal_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academic_levels = AcademicLevel::all()->pluck('level_name', 'id');

        $disciplines = Discipline::all()->pluck('discipline_name', 'id');

        $divisions = Division::all()->pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::all()->pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::all()->pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.educationalInstitutes.create', compact('legal_statuses', 'academic_levels', 'disciplines', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function store(StoreEducationalInstituteRequest $request)
    {
        $educationalInstitute = EducationalInstitute::create($request->all());
        $educationalInstitute->academic_levels()->sync($request->input('academic_levels', []));
        $educationalInstitute->disciplines()->sync($request->input('disciplines', []));

        return redirect()->route('admin.educational-institutes.index');
    }

    public function edit(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $legal_statuses = InstitutLegalStatus::all()->pluck('institute_legal_status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $academic_levels = AcademicLevel::all()->pluck('level_name', 'id');

        $disciplines = Discipline::all()->pluck('discipline_name', 'id');

        $divisions = Division::all()->pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::all()->pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::all()->pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::all()->pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $educationalInstitute->load('legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union');

        return view('admin.educationalInstitutes.edit', compact('legal_statuses', 'academic_levels', 'disciplines', 'divisions', 'districts', 'upazilas', 'unions', 'educationalInstitute'));
    }

    public function update(UpdateEducationalInstituteRequest $request, EducationalInstitute $educationalInstitute)
    {
        $educationalInstitute->update($request->all());
        $educationalInstitute->academic_levels()->sync($request->input('academic_levels', []));
        $educationalInstitute->disciplines()->sync($request->input('disciplines', []));

        return redirect()->route('admin.educational-institutes.index');
    }

    public function show(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalInstitute->load('legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union', 'eiinInstituteBankAccounts');

        return view('admin.educationalInstitutes.show', compact('educationalInstitute'));
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
