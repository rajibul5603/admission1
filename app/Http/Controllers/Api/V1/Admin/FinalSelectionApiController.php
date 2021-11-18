<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinalSelectionRequest;
use App\Http\Requests\UpdateFinalSelectionRequest;
use App\Http\Resources\Admin\FinalSelectionResource;
use App\Models\FinalSelection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalSelectionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('final_selection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinalSelectionResource(FinalSelection::with(['academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila'])->get());
    }

    public function store(StoreFinalSelectionRequest $request)
    {
        $finalSelection = FinalSelection::create($request->all());

        return (new FinalSelectionResource($finalSelection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinalSelectionResource($finalSelection->load(['academic_level', 'admission_class', 'education_institute', 'eiin', 'division', 'district', 'upazila']));
    }

    public function update(UpdateFinalSelectionRequest $request, FinalSelection $finalSelection)
    {
        $finalSelection->update($request->all());

        return (new FinalSelectionResource($finalSelection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FinalSelection $finalSelection)
    {
        abort_if(Gate::denies('final_selection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
