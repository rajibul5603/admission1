<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSelectionRequest;
use App\Http\Requests\UpdateSelectionRequest;
use App\Http\Resources\Admin\SelectionResource;
use App\Models\Selection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SelectionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('selection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SelectionResource(Selection::all());
    }

    public function store(StoreSelectionRequest $request)
    {
        $selection = Selection::create($request->all());

        return (new SelectionResource($selection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Selection $selection)
    {
        abort_if(Gate::denies('selection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SelectionResource($selection);
    }

    public function update(UpdateSelectionRequest $request, Selection $selection)
    {
        $selection->update($request->all());

        return (new SelectionResource($selection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Selection $selection)
    {
        abort_if(Gate::denies('selection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $selection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
