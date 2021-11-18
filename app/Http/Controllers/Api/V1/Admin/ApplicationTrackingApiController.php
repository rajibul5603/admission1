<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationTrackingRequest;
use App\Http\Requests\UpdateApplicationTrackingRequest;
use App\Http\Resources\Admin\ApplicationTrackingResource;
use App\Models\ApplicationTracking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationTrackingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('application_tracking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApplicationTrackingResource(ApplicationTracking::with(['user_id_no'])->get());
    }

    public function store(StoreApplicationTrackingRequest $request)
    {
        $applicationTracking = ApplicationTracking::create($request->all());

        return (new ApplicationTrackingResource($applicationTracking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApplicationTrackingResource($applicationTracking->load(['user_id_no']));
    }

    public function update(UpdateApplicationTrackingRequest $request, ApplicationTracking $applicationTracking)
    {
        $applicationTracking->update($request->all());

        return (new ApplicationTrackingResource($applicationTracking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ApplicationTracking $applicationTracking)
    {
        abort_if(Gate::denies('application_tracking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationTracking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
