<?php

namespace App\Http\Controllers\Frontend;

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

class PayrollController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payroll_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payrolls = Payroll::with(['circular', 'division', 'district', 'upazila'])->get();

        $circulars = Circular::get();

        $divisions = Division::get();

        $districts = District::get();

        $upazilas = Upazila::get();

        return view('frontend.payrolls.index', compact('payrolls', 'circulars', 'divisions', 'districts', 'upazilas'));
    }

    public function create()
    {
        abort_if(Gate::denies('payroll_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.payrolls.create', compact('circulars', 'divisions', 'districts', 'upazilas'));
    }

    public function store(StorePayrollRequest $request)
    {
        $payroll = Payroll::create($request->all());

        return redirect()->route('frontend.payrolls.index');
    }

    public function edit(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $circulars = Circular::pluck('cirucular_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $divisions = Division::pluck('division_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('upazila_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payroll->load('circular', 'division', 'district', 'upazila');

        return view('frontend.payrolls.edit', compact('circulars', 'divisions', 'districts', 'upazilas', 'payroll'));
    }

    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        $payroll->update($request->all());

        return redirect()->route('frontend.payrolls.index');
    }

    public function show(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payroll->load('circular', 'division', 'district', 'upazila', 'payrollPaymentHistories');

        return view('frontend.payrolls.show', compact('payroll'));
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
