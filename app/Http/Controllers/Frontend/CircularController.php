<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCircularRequest;
use App\Http\Requests\StoreCircularRequest;
use App\Http\Requests\UpdateCircularRequest;
use App\Models\AcademicYear;
use App\Models\Circular;
use App\Models\Policy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CircularController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('circular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::with(['academic_year', 'policy', 'media'])->get();

        $academic_years = AcademicYear::get();

        $policies = Policy::get();

        return view('frontend.circulars.index', compact('circulars', 'academic_years', 'policies'));
    }

    public function create()
    {
        abort_if(Gate::denies('circular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_years = AcademicYear::pluck('academic_year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policies = Policy::pluck('policy_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.circulars.create', compact('academic_years', 'policies'));
    }

    public function store(StoreCircularRequest $request)
    {
        $circular = Circular::create($request->all());

        if ($request->input('circular_file', false)) {
            $circular->addMedia(storage_path('tmp/uploads/' . basename($request->input('circular_file'))))->toMediaCollection('circular_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $circular->id]);
        }

        return redirect()->route('frontend.circulars.index');
    }

    public function edit(Circular $circular)
    {
        abort_if(Gate::denies('circular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_years = AcademicYear::pluck('academic_year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policies = Policy::pluck('policy_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $circular->load('academic_year', 'policy');

        return view('frontend.circulars.edit', compact('academic_years', 'policies', 'circular'));
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

        return redirect()->route('frontend.circulars.index');
    }

    public function show(Circular $circular)
    {
        abort_if(Gate::denies('circular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circular->load('academic_year', 'policy');

        return view('frontend.circulars.show', compact('circular'));
    }

    public function destroy(Circular $circular)
    {
        abort_if(Gate::denies('circular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circular->delete();

        return back();
    }

    public function massDestroy(MassDestroyCircularRequest $request)
    {
        Circular::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('circular_create') && Gate::denies('circular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Circular();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
