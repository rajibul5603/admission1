<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\GeneralInfo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DocumentsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Document::with(['app_number'])->select(sprintf('%s.*', (new Document())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'document_show';
                $editGate = 'document_edit';
                $deleteGate = 'document_delete';
                $crudRoutePart = 'documents';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('userid', function ($row) {
                return $row->userid ? $row->userid : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('sign', function ($row) {
                if ($photo = $row->sign) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('brid_copy', function ($row) {
                if ($photo = $row->brid_copy) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('nid_copy', function ($row) {
                if ($photo = $row->nid_copy) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('last_result_copy', function ($row) {
                if ($photo = $row->last_result_copy) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('institute_confirmation_letter', function ($row) {
                if ($photo = $row->institute_confirmation_letter) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('medical_certificate', function ($row) {
                if ($photo = $row->medical_certificate) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('govt_office_certificate', function ($row) {
                if ($photo = $row->govt_office_certificate) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('land_certificate', function ($row) {
                if ($photo = $row->land_certificate) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->addColumn('app_number_application_no', function ($row) {
                return $row->app_number ? $row->app_number->application_no : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo', 'sign', 'brid_copy', 'nid_copy', 'last_result_copy', 'institute_confirmation_letter', 'medical_certificate', 'govt_office_certificate', 'land_certificate', 'app_number']);

            return $table->make(true);
        }

        $general_infos = GeneralInfo::get();

        return view('admin.documents.index', compact('general_infos'));
    }

    public function create()
    {
        abort_if(Gate::denies('document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $app_numbers = GeneralInfo::all()->pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.documents.create', compact('app_numbers'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create($request->all());

        if ($request->input('photo', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('sign', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('sign'))))->toMediaCollection('sign');
        }

        if ($request->input('brid_copy', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('brid_copy'))))->toMediaCollection('brid_copy');
        }

        if ($request->input('nid_copy', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('nid_copy'))))->toMediaCollection('nid_copy');
        }

        if ($request->input('last_result_copy', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('last_result_copy'))))->toMediaCollection('last_result_copy');
        }

        if ($request->input('institute_confirmation_letter', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('institute_confirmation_letter'))))->toMediaCollection('institute_confirmation_letter');
        }

        if ($request->input('medical_certificate', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('medical_certificate'))))->toMediaCollection('medical_certificate');
        }

        if ($request->input('govt_office_certificate', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('govt_office_certificate'))))->toMediaCollection('govt_office_certificate');
        }

        if ($request->input('land_certificate', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('land_certificate'))))->toMediaCollection('land_certificate');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $document->id]);
        }

        return redirect()->route('admin.documents.index');
    }

    public function edit(Document $document)
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $app_numbers = GeneralInfo::all()->pluck('application_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $document->load('app_number');

        return view('admin.documents.edit', compact('app_numbers', 'document'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->all());

        if ($request->input('photo', false)) {
            if (!$document->photo || $request->input('photo') !== $document->photo->file_name) {
                if ($document->photo) {
                    $document->photo->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($document->photo) {
            $document->photo->delete();
        }

        if ($request->input('sign', false)) {
            if (!$document->sign || $request->input('sign') !== $document->sign->file_name) {
                if ($document->sign) {
                    $document->sign->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('sign'))))->toMediaCollection('sign');
            }
        } elseif ($document->sign) {
            $document->sign->delete();
        }

        if ($request->input('brid_copy', false)) {
            if (!$document->brid_copy || $request->input('brid_copy') !== $document->brid_copy->file_name) {
                if ($document->brid_copy) {
                    $document->brid_copy->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('brid_copy'))))->toMediaCollection('brid_copy');
            }
        } elseif ($document->brid_copy) {
            $document->brid_copy->delete();
        }

        if ($request->input('nid_copy', false)) {
            if (!$document->nid_copy || $request->input('nid_copy') !== $document->nid_copy->file_name) {
                if ($document->nid_copy) {
                    $document->nid_copy->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('nid_copy'))))->toMediaCollection('nid_copy');
            }
        } elseif ($document->nid_copy) {
            $document->nid_copy->delete();
        }

        if ($request->input('last_result_copy', false)) {
            if (!$document->last_result_copy || $request->input('last_result_copy') !== $document->last_result_copy->file_name) {
                if ($document->last_result_copy) {
                    $document->last_result_copy->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('last_result_copy'))))->toMediaCollection('last_result_copy');
            }
        } elseif ($document->last_result_copy) {
            $document->last_result_copy->delete();
        }

        if ($request->input('institute_confirmation_letter', false)) {
            if (!$document->institute_confirmation_letter || $request->input('institute_confirmation_letter') !== $document->institute_confirmation_letter->file_name) {
                if ($document->institute_confirmation_letter) {
                    $document->institute_confirmation_letter->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('institute_confirmation_letter'))))->toMediaCollection('institute_confirmation_letter');
            }
        } elseif ($document->institute_confirmation_letter) {
            $document->institute_confirmation_letter->delete();
        }

        if ($request->input('medical_certificate', false)) {
            if (!$document->medical_certificate || $request->input('medical_certificate') !== $document->medical_certificate->file_name) {
                if ($document->medical_certificate) {
                    $document->medical_certificate->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('medical_certificate'))))->toMediaCollection('medical_certificate');
            }
        } elseif ($document->medical_certificate) {
            $document->medical_certificate->delete();
        }

        if ($request->input('govt_office_certificate', false)) {
            if (!$document->govt_office_certificate || $request->input('govt_office_certificate') !== $document->govt_office_certificate->file_name) {
                if ($document->govt_office_certificate) {
                    $document->govt_office_certificate->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('govt_office_certificate'))))->toMediaCollection('govt_office_certificate');
            }
        } elseif ($document->govt_office_certificate) {
            $document->govt_office_certificate->delete();
        }

        if ($request->input('land_certificate', false)) {
            if (!$document->land_certificate || $request->input('land_certificate') !== $document->land_certificate->file_name) {
                if ($document->land_certificate) {
                    $document->land_certificate->delete();
                }
                $document->addMedia(storage_path('tmp/uploads/' . basename($request->input('land_certificate'))))->toMediaCollection('land_certificate');
            }
        } elseif ($document->land_certificate) {
            $document->land_certificate->delete();
        }

        return redirect()->route('admin.documents.index');
    }

    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->load('app_number');

        return view('admin.documents.show', compact('document'));
    }

    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentRequest $request)
    {
        Document::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('document_create') && Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Document();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
