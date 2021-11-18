<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFamilyStatusRequest;
use App\Http\Requests\UpdateFamilyStatusRequest;
use App\Http\Resources\Admin\FamilyStatusResource;
use App\Models\FamilyStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FamilyStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('family_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FamilyStatusResource(FamilyStatus::all());
    }

    public function store(StoreFamilyStatusRequest $request)
    {
        $familyStatus = FamilyStatus::create($request->all());

        return (new FamilyStatusResource($familyStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FamilyStatusResource($familyStatus);
    }

    public function update(UpdateFamilyStatusRequest $request, FamilyStatus $familyStatus)
    {
        $familyStatus->update($request->all());

        return (new FamilyStatusResource($familyStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FamilyStatus $familyStatus)
    {
        abort_if(Gate::denies('family_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
