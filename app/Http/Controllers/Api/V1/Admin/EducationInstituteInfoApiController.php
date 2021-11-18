<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationInstituteInfoRequest;
use App\Http\Requests\UpdateEducationInstituteInfoRequest;
use App\Http\Resources\Admin\EducationInstituteInfoResource;
use App\Models\EducationInstituteInfo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationInstituteInfoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('education_institute_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducationInstituteInfoResource(EducationInstituteInfo::with(['application_number', 'education_level', 'class_name', 'institute_name', 'eiin', 'last_study_class'])->get());
    }

    public function store(StoreEducationInstituteInfoRequest $request)
    {
        $educationInstituteInfo = EducationInstituteInfo::create($request->all());

        return (new EducationInstituteInfoResource($educationInstituteInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EducationInstituteInfo $educationInstituteInfo)
    {
        abort_if(Gate::denies('education_institute_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducationInstituteInfoResource($educationInstituteInfo->load(['application_number', 'education_level', 'class_name', 'institute_name', 'eiin', 'last_study_class']));
    }

    public function update(UpdateEducationInstituteInfoRequest $request, EducationInstituteInfo $educationInstituteInfo)
    {
        $educationInstituteInfo->update($request->all());

        return (new EducationInstituteInfoResource($educationInstituteInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EducationInstituteInfo $educationInstituteInfo)
    {
        abort_if(Gate::denies('education_institute_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationInstituteInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
