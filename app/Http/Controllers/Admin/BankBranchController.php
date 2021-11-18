<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BankBranchController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_branch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BankBranch::with(['bank_name', 'district', 'upazila'])->select(sprintf('%s.*', (new BankBranch())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bank_branch_show';
                $editGate = 'bank_branch_edit';
                $deleteGate = 'bank_branch_delete';
                $crudRoutePart = 'bank-branches';

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
            $table->addColumn('bank_name_name', function ($row) {
                return $row->bank_name ? $row->bank_name->name : '';
            });

            $table->editColumn('branch_name', function ($row) {
                return $row->branch_name ? $row->branch_name : '';
            });
            $table->editColumn('branch_code', function ($row) {
                return $row->branch_code ? $row->branch_code : '';
            });
            $table->addColumn('district_district_name', function ($row) {
                return $row->district ? $row->district->district_name : '';
            });

            $table->addColumn('upazila_upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->upazila_name : '';
            });

            $table->editColumn('routing_number', function ($row) {
                return $row->routing_number ? $row->routing_number : '';
            });
            $table->editColumn('swift_code', function ($row) {
                return $row->swift_code ? $row->swift_code : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('manager_name', function ($row) {
                return $row->manager_name ? $row->manager_name : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'bank_name', 'district', 'upazila', 'active']);

            return $table->make(true);
        }

        $banking_service_providers = BankingServiceProvider::get();
        $districts                 = District::get();
        $upazilas                  = Upazila::get();

        return view('admin.bankBranches.index', compact('banking_service_providers', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_branch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bankBranches.create', compact('bank_names', 'districts', 'upazilas'));
    }

    public function store(StoreBankBranchRequest $request)
    {
        $bankBranch = BankBranch::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bankBranch->id]);
        }

        return redirect()->route('admin.bank-branches.index');
    }

    public function edit(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank_names = BankingServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bankBranch->load('bank_name', 'district', 'upazila');

        return view('admin.bankBranches.edit', compact('bank_names', 'districts', 'upazilas', 'bankBranch'));
    }

    public function update(UpdateBankBranchRequest $request, BankBranch $bankBranch)
    {
        $bankBranch->update($request->all());

        return redirect()->route('admin.bank-branches.index');
    }

    public function show(BankBranch $bankBranch)
    {
        abort_if(Gate::denies('bank_branch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankBranch->load('bank_name', 'district', 'upazila');

        return view('admin.bankBranches.show', compact('bankBranch'));
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
