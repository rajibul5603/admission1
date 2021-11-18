<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAcademicLevelRequest;
use App\Http\Requests\StoreAcademicLevelRequest;
use App\Http\Requests\UpdateAcademicLevelRequest;
use App\Models\AcademicLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AcademicLevelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('academic_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AcademicLevel::query()->select(sprintf('%s.*', (new AcademicLevel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'academic_level_show';
                $editGate = 'academic_level_edit';
                $deleteGate = 'academic_level_delete';
                $crudRoutePart = 'academic-levels';

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
            $table->editColumn('level_name', function ($row) {
                return $row->level_name ? $row->level_name : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'active']);

            return $table->make(true);
        }

        return view('admin.academicLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('academic_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.academicLevels.create');
    }

    public function store(StoreAcademicLevelRequest $request)
    {
        $academicLevel = AcademicLevel::create($request->all());

        return redirect()->route('admin.academic-levels.index');
    }

    public function edit(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.academicLevels.edit', compact('academicLevel'));
    }

    public function update(UpdateAcademicLevelRequest $request, AcademicLevel $academicLevel)
    {
        $academicLevel->update($request->all());

        return redirect()->route('admin.academic-levels.index');
    }

    public function show(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicLevel->load('academicLevelLevelWiseClasses');

        return view('admin.academicLevels.show', compact('academicLevel'));
    }

    public function destroy(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyAcademicLevelRequest $request)
    {
        AcademicLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
