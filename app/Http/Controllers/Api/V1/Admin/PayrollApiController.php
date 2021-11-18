<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePayrollRequest;
use App\Http\Requests\UpdatePayrollRequest;
use App\Http\Resources\Admin\PayrollResource;
use App\Models\Payroll;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PayrollApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payroll_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayrollResource(Payroll::with(['circular', 'division', 'district', 'upazila'])->get());
    }

    public function store(StorePayrollRequest $request)
    {
        $payroll = Payroll::create($request->all());

        return (new PayrollResource($payroll))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PayrollResource($payroll->load(['circular', 'division', 'district', 'upazila']));
    }

    public function update(UpdatePayrollRequest $request, Payroll $payroll)
    {
        $payroll->update($request->all());

        return (new PayrollResource($payroll))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Payroll $payroll)
    {
        abort_if(Gate::denies('payroll_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payroll->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
