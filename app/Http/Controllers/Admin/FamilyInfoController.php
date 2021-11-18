<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class FamilyInfoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('family_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FamilyInfo::with(['application_number', 'familystatus', 'guardian_occupation'])->select(sprintf('%s.*', (new FamilyInfo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'family_info_show';
                $editGate = 'family_info_edit';
                $deleteGate = 'family_info_delete';
                $crudRoutePart = 'family-infos';

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

            $table->addColumn('familystatus_status_name', function ($row) {
                return $row->familystatus ? $row->familystatus->status_name : '';
            });

            $table->addColumn('guardian_occupation_occupation_name', function ($row) {
                return $row->guardian_occupation ? $row->guardian_occupation->occupation_name : '';
            });

            $table->editColumn('guardian_education', function ($row) {
                return $row->guardian_education ? FamilyInfo::GUARDIAN_EDUCATION_SELECT[$row->guardian_education] : '';
            });
            $table->editColumn('guardian_land', function ($row) {
                return $row->guardian_land ? $row->guardian_land : '';
            });
            $table->editColumn('guardian_annual_income', function ($row) {
                return $row->guardian_annual_income ? $row->guardian_annual_income : '';
            });
            $table->editColumn('family_member', function ($row) {
                return $row->family_member ? $row->family_member : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'application_number', 'familystatus', 'guardian_occupation']);

            return $table->make(true);
        }

        $general_infos   = GeneralInfo::get();
        $family_statuses = FamilyStatus::get();
        $occupations     = Occupation::get();

        return view('admin.familyInfos.index', compact('general_infos', 'family_statuses', 'occupations'));
    }

    public function create()
    {
        abort_if(Gate::denies('family_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $familystatuses = FamilyStatus::pluck('status_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guardian_occupations = Occupation::pluck('occupation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.familyInfos.create', compact('application_numbers', 'familystatuses', 'guardian_occupations'));
    }

    public function store(StoreFamilyInfoRequest $request)
    {
        $familyInfo = FamilyInfo::create($request->all());

        return redirect()->route('admin.family-infos.index');
    }

    public function edit(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $application_numbers = GeneralInfo::pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $familystatuses = FamilyStatus::pluck('status_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guardian_occupations = Occupation::pluck('occupation_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $familyInfo->load('application_number', 'familystatus', 'guardian_occupation');

        return view('admin.familyInfos.edit', compact('application_numbers', 'familystatuses', 'guardian_occupations', 'familyInfo'));
    }

    public function update(UpdateFamilyInfoRequest $request, FamilyInfo $familyInfo)
    {
        $familyInfo->update($request->all());

        return redirect()->route('admin.family-infos.index');
    }

    public function show(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyInfo->load('application_number', 'familystatus', 'guardian_occupation');

        return view('admin.familyInfos.show', compact('familyInfo'));
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
