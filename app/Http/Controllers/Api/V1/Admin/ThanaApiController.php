<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreThanaRequest;
use App\Http\Requests\UpdateThanaRequest;
use App\Http\Resources\Admin\ThanaResource;
use App\Models\Thana;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThanaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('thana_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ThanaResource(Thana::with(['district_name'])->get());
    }

    public function store(StoreThanaRequest $request)
    {
        $thana = Thana::create($request->all());

        return (new ThanaResource($thana))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Thana $thana)
    {
        abort_if(Gate::denies('thana_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ThanaResource($thana->load(['district_name']));
    }

    public function update(UpdateThanaRequest $request, Thana $thana)
    {
        $thana->update($request->all());

        return (new ThanaResource($thana))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Thana $thana)
    {
        abort_if(Gate::denies('thana_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $thana->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
