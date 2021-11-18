<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAcademicLevelRequest;
use App\Http\Requests\StoreAcademicLevelRequest;
use App\Http\Requests\UpdateAcademicLevelRequest;
use App\Models\AcademicLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcademicLevelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('academic_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicLevels = AcademicLevel::all();

        return view('frontend.academicLevels.index', compact('academicLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('academic_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.academicLevels.create');
    }

    public function store(StoreAcademicLevelRequest $request)
    {
        $academicLevel = AcademicLevel::create($request->all());

        return redirect()->route('frontend.academic-levels.index');
    }

    public function edit(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.academicLevels.edit', compact('academicLevel'));
    }

    public function update(UpdateAcademicLevelRequest $request, AcademicLevel $academicLevel)
    {
        $academicLevel->update($request->all());

        return redirect()->route('frontend.academic-levels.index');
    }

    public function show(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicLevel->load('academicLevelLevelWiseClasses');

        return view('frontend.academicLevels.show', compact('academicLevel'));
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
