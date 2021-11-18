<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLevelWiseClassRequest;
use App\Http\Requests\StoreLevelWiseClassRequest;
use App\Http\Requests\UpdateLevelWiseClassRequest;
use App\Models\AcademicLevel;
use App\Models\LevelWiseClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelWiseClassController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('level_wise_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $levelWiseClasses = LevelWiseClass::with(['academic_level'])->get();

        return view('admin.levelWiseClasses.index', compact('levelWiseClasses'));
    }

    public function create()
    {
        abort_if(Gate::denies('level_wise_class_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_levels = AcademicLevel::all()->pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.levelWiseClasses.create', compact('academic_levels'));
    }

    public function store(StoreLevelWiseClassRequest $request)
    {
        $levelWiseClass = LevelWiseClass::create($request->all());

        return redirect()->route('admin.level-wise-classes.index');
    }

    public function edit(LevelWiseClass $levelWiseClass)
    {
        abort_if(Gate::denies('level_wise_class_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_levels = AcademicLevel::all()->pluck('level_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $levelWiseClass->load('academic_level');

        return view('admin.levelWiseClasses.edit', compact('academic_levels', 'levelWiseClass'));
    }

    public function update(UpdateLevelWiseClassRequest $request, LevelWiseClass $levelWiseClass)
    {
        $levelWiseClass->update($request->all());

        return redirect()->route('admin.level-wise-classes.index');
    }

    public function show(LevelWiseClass $levelWiseClass)
    {
        abort_if(Gate::denies('level_wise_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $levelWiseClass->load('academic_level');

        return view('admin.levelWiseClasses.show', compact('levelWiseClass'));
    }

    public function destroy(LevelWiseClass $levelWiseClass)
    {
        abort_if(Gate::denies('level_wise_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $levelWiseClass->delete();

        return back();
    }

    public function massDestroy(MassDestroyLevelWiseClassRequest $request)
    {
        LevelWiseClass::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
