@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.disbursement.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.disbursements.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.app_number') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->app_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.stu_name') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->stu_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.brid') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->brid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.acc_no') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->acc_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.acc_name') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->acc_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.bank_name') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->bank_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.bank_branch') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->bank_branch }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.routing_no') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->routing_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.student_division') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->student_division }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.student_district') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->student_district }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.disbursement.fields.student_upazila') }}
                                    </th>
                                    <td>
                                        {{ $disbursement->student_upazila }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.disbursements.index') }}">
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