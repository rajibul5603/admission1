<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGovernmentOfficeRequest;
use App\Http\Requests\UpdateGovernmentOfficeRequest;
use App\Http\Resources\Admin\GovernmentOfficeResource;
use App\Models\GovernmentOffice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GovernmentOfficeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('government_office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GovernmentOfficeResource(GovernmentOffice::with(['ministry_name'])->get());
    }

    public function store(StoreGovernmentOfficeRequest $request)
    {
        $governmentOffice = GovernmentOffice::create($request->all());

        return (new GovernmentOfficeResource($governmentOffice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GovernmentOfficeResource($governmentOffice->load(['ministry_name']));
    }

    public function update(UpdateGovernmentOfficeRequest $request, GovernmentOffice $governmentOffice)
    {
        $governmentOffice->update($request->all());

        return (new GovernmentOfficeResource($governmentOffice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GovernmentOffice $governmentOffice)
    {
        abort_if(Gate::denies('government_office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentOffice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
