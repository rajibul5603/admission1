<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentHistoryRequest;
use App\Http\Requests\StorePaymentHistoryRequest;
use App\Http\Requests\UpdatePaymentHistoryRequest;
use App\Models\PaymentHistory;
use App\Models\Payroll;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentHistoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentHistories = PaymentHistory::with(['payroll'])->get();

        $payrolls = Payroll::get();

        return view('frontend.paymentHistories.index', compact('paymentHistories', 'payrolls'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payrolls = Payroll::pluck('payroll_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.paymentHistories.create', compact('payrolls'));
    }

    public function store(StorePaymentHistoryRequest $request)
    {
        $paymentHistory = PaymentHistory::create($request->all());

        return redirect()->route('frontend.payment-histories.index');
    }

    public function edit(PaymentHistory $paymentHistory)
    {
        abort_if(Gate::denies('payment_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payrolls = Payroll::pluck('payroll_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentHistory->load('payroll');

        return view('frontend.paymentHistories.edit', compact('payrolls', 'paymentHistory'));
    }

    public function update(UpdatePaymentHistoryRequest $request, PaymentHistory $paymentHistory)
    {
        $paymentHistory->update($request->all());

        return redirect()->route('frontend.payment-histories.index');
    }

    public function show(PaymentHistory $paymentHistory)
    {
        abort_if(Gate::denies('payment_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentHistory->load('payroll');

        return view('frontend.paymentHistories.show', compact('paymentHistory'));
    }

    public function destroy(PaymentHistory $paymentHistory)
    {
        abort_if(Gate::denies('payment_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentHistoryRequest $request)
    {
        PaymentHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
