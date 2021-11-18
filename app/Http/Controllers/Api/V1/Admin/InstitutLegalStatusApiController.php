<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstitutLegalStatusRequest;
use App\Http\Requests\UpdateInstitutLegalStatusRequest;
use App\Http\Resources\Admin\InstitutLegalStatusResource;
use App\Models\InstitutLegalStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutLegalStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('institut_legal_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstitutLegalStatusResource(InstitutLegalStatus::all());
    }

    public function store(StoreInstitutLegalStatusRequest $request)
    {
        $institutLegalStatus = InstitutLegalStatus::create($request->all());

        return (new InstitutLegalStatusResource($institutLegalStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstitutLegalStatusResource($institutLegalStatus);
    }

    public function update(UpdateInstitutLegalStatusRequest $request, InstitutLegalStatus $institutLegalStatus)
    {
        $institutLegalStatus->update($request->all());

        return (new InstitutLegalStatusResource($institutLegalStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutLegalStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
