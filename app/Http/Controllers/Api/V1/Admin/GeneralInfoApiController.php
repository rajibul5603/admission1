<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGeneralInfoRequest;
use App\Http\Requests\UpdateGeneralInfoRequest;
use App\Http\Resources\Admin\GeneralInfoResource;
use App\Models\GeneralInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralInfoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('general_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GeneralInfoResource(GeneralInfo::with(['circular', 'division', 'district', 'upazila', 'union'])->get());
    }

    public function store(StoreGeneralInfoRequest $request)
    {
        $generalInfo = GeneralInfo::create($request->all());

        return (new GeneralInfoResource($generalInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GeneralInfo $generalInfo)
    {
        abort_if(Gate::denies('general_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GeneralInfoResource($generalInfo->load(['circular', 'division', 'district', 'upazila', 'union']));
    }

    public function update(UpdateGeneralInfoRequest $request, GeneralInfo $generalInfo)
    {
        $generalInfo->update($request->all());

        return (new GeneralInfoResource($generalInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GeneralInfo $generalInfo)
    {
        abort_if(Gate::denies('general_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generalInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
