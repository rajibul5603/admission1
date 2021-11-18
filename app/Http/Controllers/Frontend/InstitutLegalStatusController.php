<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstitutLegalStatusRequest;
use App\Http\Requests\StoreInstitutLegalStatusRequest;
use App\Http\Requests\UpdateInstitutLegalStatusRequest;
use App\Models\InstitutLegalStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutLegalStatusController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('institut_legal_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutLegalStatuses = InstitutLegalStatus::all();

        return view('frontend.institutLegalStatuses.index', compact('institutLegalStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('institut_legal_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.institutLegalStatuses.create');
    }

    public function store(StoreInstitutLegalStatusRequest $request)
    {
        $institutLegalStatus = InstitutLegalStatus::create($request->all());

        return redirect()->route('frontend.institut-legal-statuses.index');
    }

    public function edit(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.institutLegalStatuses.edit', compact('institutLegalStatus'));
    }

    public function update(UpdateInstitutLegalStatusRequest $request, InstitutLegalStatus $institutLegalStatus)
    {
        $institutLegalStatus->update($request->all());

        return redirect()->route('frontend.institut-legal-statuses.index');
    }

    public function show(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.institutLegalStatuses.show', compact('institutLegalStatus'));
    }

    public function destroy(InstitutLegalStatus $institutLegalStatus)
    {
        abort_if(Gate::denies('institut_legal_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutLegalStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstitutLegalStatusRequest $request)
    {
        InstitutLegalStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
