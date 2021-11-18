<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMinistryDivisionRequest;
use App\Http\Requests\UpdateMinistryDivisionRequest;
use App\Http\Resources\Admin\MinistryDivisionResource;
use App\Models\MinistryDivision;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinistryDivisionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ministry_division_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MinistryDivisionResource(MinistryDivision::all());
    }

    public function store(StoreMinistryDivisionRequest $request)
    {
        $ministryDivision = MinistryDivision::create($request->all());

        return (new MinistryDivisionResource($ministryDivision))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MinistryDivisionResource($ministryDivision);
    }

    public function update(UpdateMinistryDivisionRequest $request, MinistryDivision $ministryDivision)
    {
        $ministryDivision->update($request->all());

        return (new MinistryDivisionResource($ministryDivision))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MinistryDivision $ministryDivision)
    {
        abort_if(Gate::denies('ministry_division_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ministryDivision->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
