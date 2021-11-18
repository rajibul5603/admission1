<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\Admin\DocumentResource;
use App\Models\Document;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentResource(Document::with(['app_number'])->get());
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

        return (new DocumentResource($document))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentResource($document->load(['app_number']));
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

        return (new DocumentResource($document))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
