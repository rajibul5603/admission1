<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDisbursementRequest;
use App\Http\Requests\StoreDisbursementRequest;
use App\Http\Requests\UpdateDisbursementRequest;
use App\Models\Disbursement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisbursementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('disbursement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disbursements = Disbursement::all();

        return view('admin.disbursements.index', compact('disbursements'));
    }

    public function create()
    {
        abort_if(Gate::denies('disbursement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disbursements.create');
    }

    public function store(StoreDisbursementRequest $request)
    {
        $disbursement = Disbursement::create($request->all());

        return redirect()->route('admin.disbursements.index');
    }

    public function edit(Disbursement $disbursement)
    {
        abort_if(Gate::denies('disbursement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disbursements.edit', compact('disbursement'));
    }

    public function update(UpdateDisbursementRequest $request, Disbursement $disbursement)
    {
        $disbursement->update($request->all());

        return redirect()->route('admin.disbursements.index');
    }

    public function show(Disbursement $disbursement)
    {
        abort_if(Gate::denies('disbursement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.disbursements.show', compact('disbursement'));
    }

    public function destroy(Disbursement $disbursement)
    {
        abort_if(Gate::denies('disbursement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disbursement->delete();

        return back();
    }

    public function massDestroy(MassDestroyDisbursementRequest $request)
    {
        Disbursement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
