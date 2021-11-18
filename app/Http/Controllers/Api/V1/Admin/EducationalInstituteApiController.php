<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationalInstituteRequest;
use App\Http\Requests\UpdateEducationalInstituteRequest;
use App\Http\Resources\Admin\EducationalInstituteResource;
use App\Models\EducationalInstitute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EducationalInstituteApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('educational_institute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducationalInstituteResource(EducationalInstitute::with(['legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union'])->get());
    }

    public function store(StoreEducationalInstituteRequest $request)
    {
        $educationalInstitute = EducationalInstitute::create($request->all());
        $educationalInstitute->academic_levels()->sync($request->input('academic_levels', []));
        $educationalInstitute->disciplines()->sync($request->input('disciplines', []));

        return (new EducationalInstituteResource($educationalInstitute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EducationalInstituteResource($educationalInstitute->load(['legal_status', 'academic_levels', 'disciplines', 'division', 'district', 'upazila', 'union']));
    }

    public function update(UpdateEducationalInstituteRequest $request, EducationalInstitute $educationalInstitute)
    {
        $educationalInstitute->update($request->all());
        $educationalInstitute->academic_levels()->sync($request->input('academic_levels', []));
        $educationalInstitute->disciplines()->sync($request->input('disciplines', []));

        return (new EducationalInstituteResource($educationalInstitute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EducationalInstitute $educationalInstitute)
    {
        abort_if(Gate::denies('educational_institute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $educationalInstitute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
