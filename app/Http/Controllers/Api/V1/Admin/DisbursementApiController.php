<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisbursementRequest;
use App\Http\Requests\UpdateDisbursementRequest;
use App\Http\Resources\Admin\DisbursementResource;
use App\Models\Disbursement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisbursementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('disbursement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DisbursementResource(Disbursement::all());
    }

    public function store(StoreDisbursementRequest $request)
    {
        $disbursement = Disbursement::create($request->all());

        return (new DisbursementResource($disbursement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Disbursement $disbursement)
    {
        abort_if(Gate::denies('disbursement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DisbursementResource($disbursement);
    }

    public function update(UpdateDisbursementRequest $request, Disbursement $disbursement)
    {
        $disbursement->update($request->all());

        return (new DisbursementResource($disbursement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Disbursement $disbursement)
    {
        abort_if(Gate::denies('disbursement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disbursement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
