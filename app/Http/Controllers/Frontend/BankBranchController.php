<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBankBranchRequest;
use App\Http\Requests\StoreBankBranchRequest;
use App\Http\Requests\UpdateBankBranchRequest;
use App\Models\BankBranch;
use App\Models\BankingServiceProvider;
use App\Models\District;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BankBranchController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_branch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankBranches = BankBranch::with(['bank_name', 'district', 'upazila'])->get();

        $banking_service_providers = BankingServiceProvider::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        return view('frontend.bankBranches.index', compact('bankBranches', 'banking_service_providers', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_branch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bankBranches.create', compact('bank_names', 'districts', 'upazilas'));
    }

    public function store(StoreBankBranchRequest $request)
    {
        $bankBranch = BankBranch::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bankBranch->id]);
        }

        return redirect()->route('frontend.bank-branches.index');
    }

    public function edit(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankBranch->load('bank_name', 'district', 'upazila');

        return view('frontend.bankBranches.edit', compact('bank_names', 'districts', 'upazilas', 'bankBranch'));
    }

    public function update(UpdateBankBranchRequest $request, BankBranch $bankBranch)
    {
        $bankBranch->update($request->all());

        return redirect()->route('frontend.bank-branches.index');
    }

    public function show(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankBranch->load('bank_name', 'district', 'upazila');

        return view('frontend.bankBranches.show', compact('bankBranch'));
    }

    public function destroy(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankBranch->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankBranchRequest $request)
    {
        BankBranch::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bank_branch_create') && Gate::denies('bank_branch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BankBranch();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
