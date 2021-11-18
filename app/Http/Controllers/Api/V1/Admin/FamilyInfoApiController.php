<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFamilyInfoRequest;
use App\Http\Requests\UpdateFamilyInfoRequest;
use App\Http\Resources\Admin\FamilyInfoResource;
use App\Models\FamilyInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FamilyInfoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('family_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FamilyInfoResource(FamilyInfo::with(['application_number', 'familystatus', 'guardian_occupation'])->get());
    }

    public function store(StoreFamilyInfoRequest $request)
    {
        $familyInfo = FamilyInfo::create($request->all());

        return (new FamilyInfoResource($familyInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FamilyInfoResource($familyInfo->load(['application_number', 'familystatus', 'guardian_occupation']));
    }

    public function update(UpdateFamilyInfoRequest $request, FamilyInfo $familyInfo)
    {
        $familyInfo->update($request->all());

        return (new FamilyInfoResource($familyInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FamilyInfo $familyInfo)
    {
        abort_if(Gate::denies('family_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $familyInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
