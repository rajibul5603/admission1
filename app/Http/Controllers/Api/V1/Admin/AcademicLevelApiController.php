<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcademicLevelRequest;
use App\Http\Requests\UpdateAcademicLevelRequest;
use App\Http\Resources\Admin\AcademicLevelResource;
use App\Models\AcademicLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcademicLevelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('academic_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AcademicLevelResource(AcademicLevel::all());
    }

    public function store(StoreAcademicLevelRequest $request)
    {
        $academicLevel = AcademicLevel::create($request->all());

        return (new AcademicLevelResource($academicLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AcademicLevelResource($academicLevel);
    }

    public function update(UpdateAcademicLevelRequest $request, AcademicLevel $academicLevel)
    {
        $academicLevel->update($request->all());

        return (new AcademicLevelResource($academicLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AcademicLevel $academicLevel)
    {
        abort_if(Gate::denies('academic_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academicLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
