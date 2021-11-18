<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCircularRequest;
use App\Http\Requests\UpdateCircularRequest;
use App\Http\Resources\Admin\CircularResource;
use App\Models\Circular;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CircularApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('circular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CircularResource(Circular::with(['academic_year', 'policy'])->get());
    }

    public function store(StoreCircularRequest $request)
    {
        $circular = Circular::create($request->all());

        if ($request->input('circular_file', false)) {
            $circular->addMedia(storage_path('tmp/uploads/' . basename($request->input('circular_file'))))->toMediaCollection('circular_file');
        }

        return (new CircularResource($circular))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Circular $circular)
    {
        abort_if(Gate::denies('circular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CircularResource($circular->load(['academic_year', 'policy']));
    }

    public function update(UpdateCircularRequest $request, Circular $circular)
    {
        $circular->update($request->all());

        if ($request->input('circular_file', false)) {
            if (!$circular->circular_file || $request->input('circular_file') !== $circular->circular_file->file_name) {
                if ($circular->circular_file) {
                    $circular->circular_file->delete();
                }
                $circular->addMedia(storage_path('tmp/uploads/' . basename($request->input('circular_file'))))->toMediaCollection('circular_file');
            }
        } elseif ($circular->circular_file) {
            $circular->circular_file->delete();
        }

        return (new CircularResource($circular))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Circular $circular)
    {
        abort_if(Gate::denies('circular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circular->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
