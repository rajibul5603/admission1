<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFinalSelectionCriterionRequest;
use App\Http\Requests\UpdateFinalSelectionCriterionRequest;
use App\Http\Resources\Admin\FinalSelectionCriterionResource;
use App\Models\FinalSelectionCriterion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalSelectionCriteriaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('final_selection_criterion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinalSelectionCriterionResource(FinalSelectionCriterion::with(['cirular', 'division', 'district', 'upazila'])->get());
    }

    public function store(StoreFinalSelectionCriterionRequest $request)
    {
        $finalSelectionCriterion = FinalSelectionCriterion::create($request->all());

        return (new FinalSelectionCriterionResource($finalSelectionCriterion))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FinalSelectionCriterionResource($finalSelectionCriterion->load(['cirular', 'division', 'district', 'upazila']));
    }

    public function update(UpdateFinalSelectionCriterionRequest $request, FinalSelectionCriterion $finalSelectionCriterion)
    {
        $finalSelectionCriterion->update($request->all());

        return (new FinalSelectionCriterionResource($finalSelectionCriterion))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FinalSelectionCriterion $finalSelectionCriterion)
    {
        abort_if(Gate::denies('final_selection_criterion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finalSelectionCriterion->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
