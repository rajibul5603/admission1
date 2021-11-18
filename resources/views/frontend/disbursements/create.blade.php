@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.disbursement.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.disbursements.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="app_number">{{ trans('cruds.disbursement.fields.app_number') }}</label>
                            <input class="form-control" type="text" name="app_number" id="app_number" value="{{ old('app_number', '') }}" required>
                            @if($errors->has('app_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('app_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.app_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="stu_name">{{ trans('cruds.disbursement.fields.stu_name') }}</label>
                            <input class="form-control" type="text" name="stu_name" id="stu_name" value="{{ old('stu_name', '') }}" required>
                            @if($errors->has('stu_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stu_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.stu_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="brid">{{ trans('cruds.disbursement.fields.brid') }}</label>
                            <input class="form-control" type="text" name="brid" id="brid" value="{{ old('brid', '') }}" required>
                            @if($errors->has('brid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.brid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="acc_no">{{ trans('cruds.disbursement.fields.acc_no') }}</label>
                            <input class="form-control" type="text" name="acc_no" id="acc_no" value="{{ old('acc_no', '') }}" required>
                            @if($errors->has('acc_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('acc_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.acc_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="acc_name">{{ trans('cruds.disbursement.fields.acc_name') }}</label>
                            <input class="form-control" type="text" name="acc_name" id="acc_name" value="{{ old('acc_name', '') }}" required>
                            @if($errors->has('acc_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('acc_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.acc_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bank_name">{{ trans('cruds.disbursement.fields.bank_name') }}</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', '') }}" required>
                            @if($errors->has('bank_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.bank_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bank_branch">{{ trans('cruds.disbursement.fields.bank_branch') }}</label>
                            <input class="form-control" type="text" name="bank_branch" id="bank_branch" value="{{ old('bank_branch', '') }}" required>
                            @if($errors->has('bank_branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.bank_branch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="routing_no">{{ trans('cruds.disbursement.fields.routing_no') }}</label>
                            <input class="form-control" type="text" name="routing_no" id="routing_no" value="{{ old('routing_no', '') }}" required>
                            @if($errors->has('routing_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('routing_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.routing_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="student_division">{{ trans('cruds.disbursement.fields.student_division') }}</label>
                            <input class="form-control" type="text" name="student_division" id="student_division" value="{{ old('student_division', '') }}" required>
                            @if($errors->has('student_division'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student_division') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.student_division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="student_district">{{ trans('cruds.disbursement.fields.student_district') }}</label>
                            <input class="form-control" type="text" name="student_district" id="student_district" value="{{ old('student_district', '') }}" required>
                            @if($errors->has('student_district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student_district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.student_district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="student_upazila">{{ trans('cruds.disbursement.fields.student_upazila') }}</label>
                            <input class="form-control" type="text" name="student_upazila" id="student_upazila" value="{{ old('student_upazila', '') }}" required>
                            @if($errors->has('student_upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student_upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.disbursement.fields.student_upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection