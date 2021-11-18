<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PaymentHistoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentHistory::with(['payroll'])->select(sprintf('%s.*', (new PaymentHistory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_history_show';
                $editGate = 'payment_history_edit';
                $deleteGate = 'payment_history_delete';
                $crudRoutePart = 'payment-histories';

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
            $table->addColumn('payroll_payroll_name', function ($row) {
                return $row->payroll ? $row->payroll->payroll_name : '';
            });

            $table->editColumn('app_number', function ($row) {
                return $row->app_number ? $row->app_number : '';
            });
            $table->editColumn('stu_name', function ($row) {
                return $row->stu_name ? $row->stu_name : '';
            });
            $table->editColumn('bank_acc_no', function ($row) {
                return $row->bank_acc_no ? $row->bank_acc_no : '';
            });
            $table->editColumn('student_bank_name', function ($row) {
                return $row->student_bank_name ? $row->student_bank_name : '';
            });
            $table->editColumn('student_division', function ($row) {
                return $row->student_division ? $row->student_division : '';
            });
            $table->editColumn('student_district', function ($row) {
                return $row->student_district ? $row->student_district : '';
            });
            $table->editColumn('student_upazila', function ($row) {
                return $row->student_upazila ? $row->student_upazila : '';
            });
            $table->editColumn('pay_amount', function ($row) {
                return $row->pay_amount ? $row->pay_amount : '';
            });

            $table->editColumn('disbursement_status', function ($row) {
                return $row->disbursement_status ? PaymentHistory::DISBURSEMENT_STATUS_SELECT[$row->disbursement_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'payroll']);

            return $table->make(true);
        }

        $payrolls = Payroll::get();

        return view('admin.paymentHistories.index', compact('payrolls'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payrolls = Payroll::all()->pluck('payroll_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.paymentHistories.create', compact('payrolls'));
    }

    public function store(StorePaymentHistoryRequest $request)
    {
        $paymentHistory = PaymentHistory::create($request->all());

        return redirect()->route('admin.payment-histories.index');
    }

    public function edit(PaymentHistory $paymentHistory)
    {
        abort_if(Gate::denies('payment_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payrolls = Payroll::all()->pluck('payroll_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentHistory->load('payroll');

        return view('admin.paymentHistories.edit', compact('payrolls', 'paymentHistory'));
    }

    public function update(UpdatePaymentHistoryRequest $request, PaymentHistory $paymentHistory)
    {
        $paymentHistory->update($request->all());

        return redirect()->route('admin.payment-histories.index');
    }

    public function show(PaymentHistory $paymentHistory)
    {
        abort_if(Gate::denies('payment_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentHistory->load('payroll');

        return view('admin.paymentHistories.show', compact('paymentHistory'));
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
