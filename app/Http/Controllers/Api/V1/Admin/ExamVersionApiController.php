<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamVersionRequest;
use App\Http\Requests\UpdateExamVersionRequest;
use App\Http\Resources\Admin\ExamVersionResource;
use App\Models\ExamVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamVersionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('exam_version_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExamVersionResource(ExamVersion::all());
    }

    public function store(StoreExamVersionRequest $request)
    {
        $examVersion = ExamVersion::create($request->all());

        return (new ExamVersionResource($examVersion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExamVersionResource($examVersion);
    }

    public function update(UpdateExamVersionRequest $request, ExamVersion $examVersion)
    {
        $examVersion->update($request->all());

        return (new ExamVersionResource($examVersion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExamVersion $examVersion)
    {
        abort_if(Gate::denies('exam_version_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $examVersion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
