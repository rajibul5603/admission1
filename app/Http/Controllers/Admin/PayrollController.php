<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPayrollRequest;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Models\Circular;
use App\Models\District;
use App\Models\Division;
use App\Models\Payroll;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PayrollController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payroll_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Payroll::with(['circular', 'division', 'district', 'upazila'])->select(sprintf('%s.*', (new Payroll())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payroll_show';
                $editGate = 'payroll_edit';
                $deleteGate = 'payroll_delete';
                $crudRoutePart = 'payrolls';

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
            $table->editColumn('payroll_name', function ($row) {
                return $row->payroll_name ? $row->payroll_name : '';
            });
            $table->addColumn('circular_cirucular_name', function ($row) {
                return $row->circular ? $row->circular->cirucular_name : '';
            });

            $table->addColumn('division_division_name', function ($row) {
                return $row->division ? $row->division->division_name : '';
            });

            $table->addColumn('district_district_name', function ($row) {
                return $row->district ? $row->district->district_name : '';
            });

            $table->addColumn('upazila_upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->upazila_name : '';
            });

            $table->editColumn('total_student', function ($row) {
                return $row->total_student ? $row->total_student : '';
            });
            $table->editColumn('financial_institutaion', function ($row) {
                return $row->financial_institutaion ? $row->financial_institutaion : '';
            });
            $table->editColumn('total_assistance', function ($row) {
                return $row->total_assistance ? $row->total_assistance : '';
            });
            $table->editColumn('total_disbursement', function ($row) {
                return $row->total_disbursement ? $row->total_disbursement : '';
            });
            $table->editColumn('disbursement_status', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->disbursement_status ? 'checked' : null) . '>';
            });

            $table->editColumn('api_key', function ($row) {
                return $row->api_key ? $row->api_key : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'circular', 'division', 'district', 'upazila', 'disbursement_status']);

            return $table->make(true);
        }

        $circulars = Circular::get();
        $divisions = Division::get();
        $districts = District::get();
        $upazilas  = Upazila::get();

        return view('admin.payrolls.index', compact('circulars', 'divisions', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('payroll_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.payrolls.create', compact('circulars', 'divisions', 'districts', 'upazilas'));
    }

    public function store(StorePayrollRequest $request)
    {
        $payroll = Payroll::create($request->all());

        return redirect()->route('admin.payrolls.index');
    }

    public function edit(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payroll->load('circular', 'division', 'district', 'upazila');

        return view('admin.payrolls.edit', compact('circulars', 'divisions', 'districts', 'upazilas', 'payroll'));
    }

    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        $payroll->update($request->all());

        return redirect()->route('admin.payrolls.index');
    }

    public function show(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payroll->load('circular', 'division', 'district', 'upazila', 'payrollPaymentHistories');

        return view('admin.payrolls.show', compact('payroll'));
    }

    public function destroy(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payroll->delete();

        return back();
    }

    public function massDestroy(MassDestroyPayrollRequest $request)
    {
        Payroll::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
