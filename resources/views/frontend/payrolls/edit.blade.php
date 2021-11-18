@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.payroll.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.payrolls.update", [$payroll->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="payroll_name">{{ trans('cruds.payroll.fields.payroll_name') }}</label>
                            <input class="form-control" type="text" name="payroll_name" id="payroll_name" value="{{ old('payroll_name', $payroll->payroll_name) }}" required>
                            @if($errors->has('payroll_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('payroll_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.payroll_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="circular_id">{{ trans('cruds.payroll.fields.circular') }}</label>
                            <select class="form-control select2" name="circular_id" id="circular_id" required>
                                @foreach($circulars as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('circular_id') ? old('circular_id') : $payroll->circular->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('circular'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('circular') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.circular_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="division_id">{{ trans('cruds.payroll.fields.division') }}</label>
                            <select class="form-control select2" name="division_id" id="division_id">
                                @foreach($divisions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $payroll->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('division'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="district_id">{{ trans('cruds.payroll.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id">
                                @foreach($districts as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $payroll->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upazila_id">{{ trans('cruds.payroll.fields.upazila') }}</label>
                            <select class="form-control select2" name="upazila_id" id="upazila_id">
                                @foreach($upazilas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $payroll->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="total_student">{{ trans('cruds.payroll.fields.total_student') }}</label>
                            <input class="form-control" type="number" name="total_student" id="total_student" value="{{ old('total_student', $payroll->total_student) }}" step="1" required>
                            @if($errors->has('total_student'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_student') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.total_student_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="financial_institutaion">{{ trans('cruds.payroll.fields.financial_institutaion') }}</label>
                            <input class="form-control" type="text" name="financial_institutaion" id="financial_institutaion" value="{{ old('financial_institutaion', $payroll->financial_institutaion) }}">
                            @if($errors->has('financial_institutaion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('financial_institutaion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.financial_institutaion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_assistance">{{ trans('cruds.payroll.fields.total_assistance') }}</label>
                            <input class="form-control" type="number" name="total_assistance" id="total_assistance" value="{{ old('total_assistance', $payroll->total_assistance) }}" step="0.01">
                            @if($errors->has('total_assistance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_assistance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.total_assistance_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_disbursement">{{ trans('cruds.payroll.fields.total_disbursement') }}</label>
                            <input class="form-control" type="number" name="total_disbursement" id="total_disbursement" value="{{ old('total_disbursement', $payroll->total_disbursement) }}" step="0.01">
                            @if($errors->has('total_disbursement'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_disbursement') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.total_disbursement_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="disbursement_status" id="disbursement_status" value="1" {{ $payroll->disbursement_status || old('disbursement_status', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="disbursement_status">{{ trans('cruds.payroll.fields.disbursement_status') }}</label>
                            </div>
                            @if($errors->has('disbursement_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('disbursement_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.disbursement_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="activation_date">{{ trans('cruds.payroll.fields.activation_date') }}</label>
                            <input class="form-control date" type="text" name="activation_date" id="activation_date" value="{{ old('activation_date', $payroll->activation_date) }}">
                            @if($errors->has('activation_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('activation_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.activation_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="deactivation_date">{{ trans('cruds.payroll.fields.deactivation_date') }}</label>
                            <input class="form-control date" type="text" name="deactivation_date" id="deactivation_date" value="{{ old('deactivation_date', $payroll->deactivation_date) }}">
                            @if($errors->has('deactivation_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('deactivation_date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.deactivation_date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="api_key">{{ trans('cruds.payroll.fields.api_key') }}</label>
                            <input class="form-control" type="text" name="api_key" id="api_key" value="{{ old('api_key', $payroll->api_key) }}">
                            @if($errors->has('api_key'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('api_key') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.payroll.fields.api_key_helper') }}</span>
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