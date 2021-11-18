<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class GeneralInfoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('general_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GeneralInfo::with(['circular', 'division', 'district', 'upazila', 'union'])->select(sprintf('%s.*', (new GeneralInfo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'general_info_show';
                $editGate = 'general_info_edit';
                $deleteGate = 'general_info_delete';
                $crudRoutePart = 'general-infos';

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
            $table->editColumn('application_no', function ($row) {
                return $row->application_no ? $row->application_no : '';
            });
            $table->editColumn('brid', function ($row) {
                return $row->brid ? $row->brid : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('father_name', function ($row) {
                return $row->father_name ? $row->father_name : '';
            });

            $table->editColumn('gender', function ($row) {
                return $row->gender ? GeneralInfo::GENDER_SELECT[$row->gender] : '';
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

            $table->rawColumns(['actions', 'placeholder', 'division', 'district', 'upazila', 'union']);

            return $table->make(true);
        }

        $circulars = Circular::get();
        $divisions = Division::get();
        $districts = District::get();
        $upazilas  = Upazila::get();
        $unions    = Union::get();

        return view('admin.generalInfos.index', compact('circulars', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function create()
    {
        abort_if(Gate::denies('general_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('union_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.generalInfos.create', compact('circulars', 'divisions', 'districts', 'upazilas', 'unions'));
    }

    public function store(StoreGeneralInfoRequest $request)
    {
        $generalInfo = GeneralInfo::create($request->all());

        return redirect()->route('admin.general-infos.index');
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

        return view('admin.generalInfos.edit', compact('circulars', 'divisions', 'districts', 'upazilas', 'unions', 'generalInfo'));
    }

    public function update(UpdateGeneralInfoRequest $request, GeneralInfo $generalInfo)
    {
        $generalInfo->update($request->all());

        return redirect()->route('admin.general-infos.index');
    }

    public function show(GeneralInfo $generalInfo)
    {
        abort_if(Gate::denies('general_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generalInfo->load('circular', 'division', 'district', 'upazila', 'union', 'applicationNumberFamilyInfos', 'appNumberDocuments', 'applicationNumberEducationInstituteInfos', 'appNumberAccountInfos');

        return view('admin.generalInfos.show', compact('generalInfo'));
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
