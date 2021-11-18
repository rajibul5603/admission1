<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;
use Image;

class CircularController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('circular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Circular::with(['academic_year', 'policy'])->select(sprintf('%s.*', (new Circular())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'circular_show';
                $editGate = 'circular_edit';
                $deleteGate = 'circular_delete';
                $crudRoutePart = 'circulars';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('circular_type', function ($row) {
                return $row->circular_type ? Circular::CIRCULAR_TYPE_SELECT[$row->circular_type] : '';
            });
            $table->editColumn('cirucular_name', function ($row) {
                return $row->cirucular_name ? $row->cirucular_name : '';
            });
            $table->editColumn('circular_year', function ($row) {
                return $row->circular_year ? $row->circular_year : '';
            });
            $table->addColumn('academic_year_academic_year', function ($row) {
                return $row->academic_year ? $row->academic_year->academic_year : '';
            });

            $table->addColumn('policy_policy_name', function ($row) {
                return $row->policy ? $row->policy->policy_name : '';
            });

            $table->editColumn('sec_stipend_amount', function ($row) {
                return $row->sec_stipend_amount ? $row->sec_stipend_amount : '';
            });
            $table->editColumn('hsec_stipend_amount', function ($row) {
                return $row->hsec_stipend_amount ? $row->hsec_stipend_amount : '';
            });
            $table->editColumn('hons_stipend_amount', function ($row) {
                return $row->hons_stipend_amount ? $row->hons_stipend_amount : '';
            });

            $table->editColumn('circular_file', function ($row) {
                return $row->circular_file ? '<a href="' . $row->circular_file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'academic_year', 'policy', 'circular_file']);

            return $table->make(true);
        }

        $academic_years = AcademicYear::get();
        $policies       = Policy::get();

        return view('admin.circulars.index', compact('academic_years', 'policies'));
    }

    public function create()
    {
        abort_if(Gate::denies('circular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_years = AcademicYear::pluck('academic_year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policies = Policy::pluck('policy_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.circulars.create', compact('academic_years', 'policies'));
    }

    public function store(StoreCircularRequest $request)
    {


        if ($request->hasFile('circular_image')) {
            $image = $request->file('circular_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('circular/' . $filename);
            $previewLocation = public_path('circular/thumbnail/' . $filename);


            Image::make($image)->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($previewLocation);


            Image::make($image)->save($location);

            $request->circular_image = $filename;
        }

        $circular = Circular::create([
            'circular_type' => $request->circular_type,
            'cirucular_name' => $request->cirucular_name,
            'circular_year' => $request->circular_year,
            'reference_number' => $request->reference_number,
            'reference_date' => $request->reference_date,
            'policy_id' => $request->policy_id,
            'sec_stipend_amount' => $request->sec_stipend_amount,
            'hsec_stipend_amount' => $request->hsec_stipend_amount,
            'hons_stipend_amount' => $request->hons_stipend_amount,
            'application_deadline' => $request->application_deadline,
            'institution_head_deadline' => $request->institution_head_deadline,
            'circular_status' => $request->circular_status,
            'academic_year_id' => $request->academic_year_id,
            'circular_image' => $request->circular_image,
        ]);

        ///  dd($request->all())

        // $circular = Circular::create($request->all());


        if ($request->input('circular_file', false)) {
            $circular->addMedia(storage_path('tmp/uploads/' . basename($request->input('circular_file'))))->toMediaCollection('circular_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $circular->id]);
        }

        return redirect()->route('admin.circulars.index');
    }

    public function edit(Circular $circular)
    {
        abort_if(Gate::denies('circular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academic_years = AcademicYear::pluck('academic_year', 'id')->prepend(trans('global.pleaseSelect'), '');

        $policies = Policy::pluck('policy_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $circular->load('academic_year', 'policy');

        return view('admin.circulars.edit', compact('academic_years', 'policies', 'circular'));
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

        return redirect()->route('admin.circulars.index');
    }

    public function show(Circular $circular)
    {
        abort_if(Gate::denies('circular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circular->load('academic_year', 'policy');

        return view('admin.circulars.show', compact('circular'));
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
