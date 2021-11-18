@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.educationalInstitute.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.educational-institutes.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="institution_eiin_no">{{ trans('cruds.educationalInstitute.fields.institution_eiin_no') }}</label>
                            <input class="form-control" type="text" name="institution_eiin_no" id="institution_eiin_no" value="{{ old('institution_eiin_no', '') }}" required>
                            @if($errors->has('institution_eiin_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institution_eiin_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.institution_eiin_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="institution_name">{{ trans('cruds.educationalInstitute.fields.institution_name') }}</label>
                            <input class="form-control" type="text" name="institution_name" id="institution_name" value="{{ old('institution_name', '') }}" required>
                            @if($errors->has('institution_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institution_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.institution_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="institution_code">{{ trans('cruds.educationalInstitute.fields.institution_code') }}</label>
                            <input class="form-control" type="text" name="institution_code" id="institution_code" value="{{ old('institution_code', '') }}">
                            @if($errors->has('institution_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institution_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.institution_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mpo_number">{{ trans('cruds.educationalInstitute.fields.mpo_number') }}</label>
                            <input class="form-control" type="text" name="mpo_number" id="mpo_number" value="{{ old('mpo_number', '') }}">
                            @if($errors->has('mpo_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mpo_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.mpo_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="legal_status_id">{{ trans('cruds.educationalInstitute.fields.legal_status') }}</label>
                            <select class="form-control select2" name="legal_status_id" id="legal_status_id">
                                @foreach($legal_statuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('legal_status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('legal_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('legal_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.legal_status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="academic_levels">{{ trans('cruds.educationalInstitute.fields.academic_level') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="academic_levels[]" id="academic_levels" multiple>
                                @foreach($academic_levels as $id => $academic_level)
                                    <option value="{{ $id }}" {{ in_array($id, old('academic_levels', [])) ? 'selected' : '' }}>{{ $academic_level }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('academic_levels'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('academic_levels') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.academic_level_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="disciplines">{{ trans('cruds.educationalInstitute.fields.discipline') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="disciplines[]" id="disciplines" multiple>
                                @foreach($disciplines as $id => $discipline)
                                    <option value="{{ $id }}" {{ in_array($id, old('disciplines', [])) ? 'selected' : '' }}>{{ $discipline }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('disciplines'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('disciplines') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.discipline_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="institute_head">{{ trans('cruds.educationalInstitute.fields.institute_head') }}</label>
                            <input class="form-control" type="text" name="institute_head" id="institute_head" value="{{ old('institute_head', '') }}">
                            @if($errors->has('institute_head'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute_head') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.institute_head_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.educationalInstitute.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone">{{ trans('cruds.educationalInstitute.fields.mobile_phone') }}</label>
                            <input class="form-control" type="number" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone', '') }}" step="1">
                            @if($errors->has('mobile_phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile_phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.mobile_phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.educationalInstitute.fields.phone') }}</label>
                            <input class="form-control" type="number" name="phone" id="phone" value="{{ old('phone', '') }}" step="1">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="division_id">{{ trans('cruds.educationalInstitute.fields.division') }}</label>
                            <select class="form-control select2" name="division_id" id="division_id" required>
                                @foreach($divisions as $id => $entry)
                                    <option value="{{ $id }}" {{ old('division_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('division'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="district_id">{{ trans('cruds.educationalInstitute.fields.district') }}</label>
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
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upazila_id">{{ trans('cruds.educationalInstitute.fields.upazila') }}</label>
                            <select class="form-control select2" name="upazila_id" id="upazila_id">
                                @foreach($upazilas as $id => $entry)
                                    <option value="{{ $id }}" {{ old('upazila_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="union_id">{{ trans('cruds.educationalInstitute.fields.union') }}</label>
                            <select class="form-control select2" name="union_id" id="union_id">
                                @foreach($unions as $id => $entry)
                                    <option value="{{ $id }}" {{ old('union_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('union'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('union') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.educationalInstitute.fields.union_helper') }}</span>
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