<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEducationInstituteInfoRequest;
use App\Http\Requests\StoreEducationInstituteInfoRequest;
use App\Http\Requests\UpdateEducationInstituteInfoRequest;
use App\Models\AcademicLevel;
use App\Models\EducationalInstitute;
use App\Models\EducationInstituteInfo;
use App\Models\GeneralInfo;
use App\Models\LevelWiseClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EducationInstituteInfoController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('education_institute_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EducationInstituteInfo::with(['application_number', 'education_level', 'class_name', 'institute_name', 'eiin', 'last_study_class'])->select(sprintf('%s.*', (new EducationInstituteInfo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'education_institute_info_show';
                $editGate = 'education_institute_info_edit';
                $deleteGate = 'education_institute_info_delete';
                $crudRoutePart = 'education-institute-infos';

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
            $table->addColumn('application_number_application_no', function ($row) {
                return $row->application_number ? $row->application_number->application_no : '';
            });

            $table->addColumn('education_level_level_name', function ($row) {
                return $row->education_level ? $row->education_level->level_name : '';
            });

            $table->addColumn('eiin_institution_eiin_no', function ($row) {
                return $row->eiin ? $row->eiin->institution_eiin_no : '';
            });

            $table->editColumn('last_gpa', function ($row) {
                return $row->last_gpa ? $row->last_gpa : '';
            });
            $table->editColumn('last_gpa_total', function ($row) {
                return $row->last_gpa_total ? $row->last_gpa_total : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'application_number', 'education_level', 'eiin']);

            return $table->make(true);
        }

        $general_infos          = GeneralInfo::get();
        $academic_levels        = AcademicLevel::get();
        $level_wise_classes     = LevelWiseClass::get();
        $educational_institutes = EducationalInstitute::get();

        return view('admin.educationInstituteInfos.index', compact('general_infos', 'academic_levels', 'level_wise_classes', 'educational_institutes'));
    }

    public function create()
    {
        abort_if(Gate::denies('education_institute_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education_levels = AcademicLevel::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $class_names = LevelWiseClass::pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institute_names = EducationalInstitute::pluck('institution_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = EducationalInstitute::pluck('institution_eiin_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_study_classes = LevelWiseClass::pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.educationInstituteInfos.create', compact('application_numbers', 'education_levels', 'class_names', 'institute_names', 'eiins', 'last_study_classes'));
    }

    public function store(StoreEducationInstituteInfoRequest $request)
    {
        $educationInstituteInfo = EducationInstituteInfo::create($request->all());

        return redirect()->route('admin.education-institute-infos.index');
    }

    public function edit(EducationInstituteInfo $educationInstituteInfo)
    {
        abort_if(Gate::denies('education_institute_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $education_levels = AcademicLevel::pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $class_names = LevelWiseClass::pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $institute_names = EducationalInstitute::pluck('institution_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eiins = EducationalInstitute::pluck('institution_eiin_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $last_study_classes = LevelWiseClass::pluck('class_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $educationInstituteInfo->load('application_number', 'education_level', 'class_name', 'institute_name', 'eiin', 'last_study_class');

        return view('admin.educationInstituteInfos.edit', compact('application_numbers', 'education_levels', 'class_names', 'institute_names', 'eiins', 'last_study_classes', 'educationInstituteInfo'));
    }

    public function update(UpdateEducationInstituteInfoRequest $request, EducationInstituteInfo $educationInstituteInfo)
    {
        $educationInstituteInfo->update($request->all());

        return redirect()->route('admin.education-institute-infos.index');
    }

    public function show(EducationInstituteInfo $educationInstituteInfo)
    {
        abort_if(Gate::denies('education_institute_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationInstituteInfo->load('application_number', 'education_level', 'class_name', 'institute_name', 'eiin', 'last_study_class');

        return view('admin.educationInstituteInfos.show', compact('educationInstituteInfo'));
    }

    public function destroy(EducationInstituteInfo $educationInstituteInfo)
    {
        abort_if(Gate::denies('education_institute_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationInstituteInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyEducationInstituteInfoRequest $request)
    {
        EducationInstituteInfo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
