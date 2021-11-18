@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.accountInfo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.account-infos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user">{{ trans('cruds.accountInfo.fields.user') }}</label>
                            <input class="form-control" type="text" name="user" id="user" value="{{ old('user', '') }}" required>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="app_number_id">{{ trans('cruds.accountInfo.fields.app_number') }}</label>
                            <select class="form-control select2" name="app_number_id" id="app_number_id" required>
                                @foreach($app_numbers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('app_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('app_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('app_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.app_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="student_name">{{ trans('cruds.accountInfo.fields.student_name') }}</label>
                            <input class="form-control" type="text" name="student_name" id="student_name" value="{{ old('student_name', '') }}" required>
                            @if($errors->has('student_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('student_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.student_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="banking_type_id">{{ trans('cruds.accountInfo.fields.banking_type') }}</label>
                            <select class="form-control select2" name="banking_type_id" id="banking_type_id" required>
                                @foreach($banking_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('banking_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('banking_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('banking_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.banking_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bank_name_id">{{ trans('cruds.accountInfo.fields.bank_name') }}</label>
                            <select class="form-control select2" name="bank_name_id" id="bank_name_id" required>
                                @foreach($bank_names as $id => $entry)
                                    <option value="{{ $id }}" {{ old('bank_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.bank_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="district_id">{{ trans('cruds.accountInfo.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id">
                                @foreach($districts as $id => $entry)
                                    <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bank_branch_id">{{ trans('cruds.accountInfo.fields.bank_branch') }}</label>
                            <select class="form-control select2" name="bank_branch_id" id="bank_branch_id">
                                @foreach($bank_branches as $id => $entry)
                                    <option value="{{ $id }}" {{ old('bank_branch_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_branch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_branch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.bank_branch_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="routing_no">{{ trans('cruds.accountInfo.fields.routing_no') }}</label>
                            <input class="form-control" type="text" name="routing_no" id="routing_no" value="{{ old('routing_no', '') }}" required>
                            @if($errors->has('routing_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('routing_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.routing_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.accountInfo.fields.bank_account_owner') }}</label>
                            <select class="form-control" name="bank_account_owner" id="bank_account_owner" required>
                                <option value disabled {{ old('bank_account_owner', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AccountInfo::BANK_ACCOUNT_OWNER_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('bank_account_owner', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_account_owner'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_account_owner') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.bank_account_owner_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="acc_name">{{ trans('cruds.accountInfo.fields.acc_name') }}</label>
                            <input class="form-control" type="text" name="acc_name" id="acc_name" value="{{ old('acc_name', '') }}" required>
                            @if($errors->has('acc_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('acc_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.acc_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="acc_no">{{ trans('cruds.accountInfo.fields.acc_no') }}</label>
                            <input class="form-control" type="text" name="acc_no" id="acc_no" value="{{ old('acc_no', '') }}" required>
                            @if($errors->has('acc_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('acc_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.acc_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.accountInfo.fields.account_type') }}</label>
                            <select class="form-control" name="account_type" id="account_type">
                                <option value disabled {{ old('account_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AccountInfo::ACCOUNT_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('account_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('account_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.account_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="branch_code_id">{{ trans('cruds.accountInfo.fields.branch_code') }}</label>
                            <select class="form-control select2" name="branch_code_id" id="branch_code_id">
                                @foreach($branch_codes as $id => $entry)
                                    <option value="{{ $id }}" {{ old('branch_code_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('branch_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.branch_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="account_holder_nid">{{ trans('cruds.accountInfo.fields.account_holder_nid') }}</label>
                            <input class="form-control" type="number" name="account_holder_nid" id="account_holder_nid" value="{{ old('account_holder_nid', '') }}" step="1" required>
                            @if($errors->has('account_holder_nid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('account_holder_nid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.account_holder_nid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="eiin">{{ trans('cruds.accountInfo.fields.eiin') }}</label>
                            <input class="form-control" type="text" name="eiin" id="eiin" value="{{ old('eiin', '') }}">
                            @if($errors->has('eiin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('eiin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.accountInfo.fields.eiin_helper') }}</span>
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