<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLevelWiseClassRequest;
use App\Http\Requests\UpdateLevelWiseClassRequest;
use App\Http\Resources\Admin\LevelWiseClassResource;
use App\Models\LevelWiseClass;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelWiseClassApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('level_wise_class_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LevelWiseClassResource(LevelWiseClass::with(['academic_level'])->get());
    }

    public function store(StoreLevelWiseClassRequest $request)
    {
        $levelWiseClass = LevelWiseClass::create($request->all());

        return (new LevelWiseClassResource($levelWiseClass))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LevelWiseClass $levelWiseClass)
    {
        abort_if(Gate::denies('level_wise_class_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LevelWiseClassResource($levelWiseClass->load(['academic_level']));
    }

    public function update(UpdateLevelWiseClassRequest $request, LevelWiseClass $levelWiseClass)
    {
        $levelWiseClass->update($request->all());

        return (new LevelWiseClassResource($levelWiseClass))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LevelWiseClass $levelWiseClass)
    {
        abort_if(Gate::denies('level_wise_class_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $levelWiseClass->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
