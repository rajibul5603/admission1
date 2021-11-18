@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.payroll.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.payrolls.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $payroll->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.payroll_name') }}
                                    </th>
                                    <td>
                                        {{ $payroll->payroll_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.circular') }}
                                    </th>
                                    <td>
                                        {{ $payroll->circular->cirucular_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $payroll->division->division_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.district') }}
                                    </th>
                                    <td>
                                        {{ $payroll->district->district_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.upazila') }}
                                    </th>
                                    <td>
                                        {{ $payroll->upazila->upazila_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.total_student') }}
                                    </th>
                                    <td>
                                        {{ $payroll->total_student }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.financial_institutaion') }}
                                    </th>
                                    <td>
                                        {{ $payroll->financial_institutaion }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.total_assistance') }}
                                    </th>
                                    <td>
                                        {{ $payroll->total_assistance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.total_disbursement') }}
                                    </th>
                                    <td>
                                        {{ $payroll->total_disbursement }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.disbursement_status') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $payroll->disbursement_status ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.activation_date') }}
                                    </th>
                                    <td>
                                        {{ $payroll->activation_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.deactivation_date') }}
                                    </th>
                                    <td>
                                        {{ $payroll->deactivation_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.payroll.fields.api_key') }}
                                    </th>
                                    <td>
                                        {{ $payroll->api_key }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.payrolls.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection