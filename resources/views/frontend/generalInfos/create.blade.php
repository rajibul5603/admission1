@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.generalInfo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.general-infos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        
                        <div class="form-group">
                            <label class="required" for="user_id_no">{{ trans('cruds.generalInfo.fields.user_id_no') }}</label>
                            <input class="form-control" type="text" name="user_id_no" id="user_id_no" value="{{ old('user_id_no', '') }}" required>
                            @if($errors->has('user_id_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('user_id_no') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.user_id_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="application_no">{{ trans('cruds.generalInfo.fields.application_no') }}</label>
                            <input class="form-control" type="text" name="application_no" id="application_no" value="{{ old('application_no', '') }}" required>
                            @if($errors->has('application_no'))
                            <div class="invalid-feedback">
                                {{ $errors->first('application_no') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.application_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="grants_name">{{ trans('cruds.generalInfo.fields.grants_name') }}</label>
                            <input class="form-control" type="text" name="grants_name" id="grants_name" value="{{ old('grants_name', '') }}" required>
                            @if($errors->has('grants_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('grants_name') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.grants_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="circular_id">{{ trans('cruds.generalInfo.fields.circular') }}</label>
                            <select class="form-control select2" name="circular_id" id="circular_id" required>
                                @foreach($circulars as $id => $entry)
                                <option value="{{ $id }}" {{ old('circular_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('circular'))
                            <div class="invalid-feedback">
                                {{ $errors->first('circular') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.circular_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="brid">{{ trans('cruds.generalInfo.fields.brid') }}</label>
                            <input class="form-control" type="text" name="brid" id="brid" value="{{ old('brid', '') }}" required>
                            @if($errors->has('brid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('brid') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.brid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="nid">{{ trans('cruds.generalInfo.fields.nid') }}</label>
                            <input class="form-control" type="text" name="nid" id="nid" value="{{ old('nid', '') }}">
                            @if($errors->has('nid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nid') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.nid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.generalInfo.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="father_name">{{ trans('cruds.generalInfo.fields.father_name') }}</label>
                            <input class="form-control" type="text" name="father_name" id="father_name" value="{{ old('father_name', '') }}" required>
                            @if($errors->has('father_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('father_name') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.father_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="father_nid">{{ trans('cruds.generalInfo.fields.father_nid') }}</label>
                            <input class="form-control" type="number" name="father_nid" id="father_nid" value="{{ old('father_nid', '') }}" step="1">
                            @if($errors->has('father_nid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('father_nid') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.father_nid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="mother_name">{{ trans('cruds.generalInfo.fields.mother_name') }}</label>
                            <input class="form-control" type="text" name="mother_name" id="mother_name" value="{{ old('mother_name', '') }}" required>
                            @if($errors->has('mother_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mother_name') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.mother_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mother_nid">{{ trans('cruds.generalInfo.fields.mother_nid') }}</label>
                            <input class="form-control" type="number" name="mother_nid" id="mother_nid" value="{{ old('mother_nid', '') }}" step="1">
                            @if($errors->has('mother_nid'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mother_nid') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.mother_nid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="dob">{{ trans('cruds.generalInfo.fields.dob') }}</label>
                            <input class="form-control date" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                            @if($errors->has('dob'))
                            <div class="invalid-feedback">
                                {{ $errors->first('dob') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.dob_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="age">{{ trans('cruds.generalInfo.fields.age') }}</label>
                            <input class="form-control" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1" required>
                            @if($errors->has('age'))
                            <div class="invalid-feedback">
                                {{ $errors->first('age') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.age_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.generalInfo.fields.gender') }}</label>
                            <select class="form-control" name="gender" id="gender">
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\GeneralInfo::GENDER_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gender'))
                            <div class="invalid-feedback">
                                {{ $errors->first('gender') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="division_id">{{ trans('cruds.generalInfo.fields.division') }}</label>
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
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="district_id">{{ trans('cruds.generalInfo.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id" required>
                                @foreach($districts as $id => $entry)
                                <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                            <div class="invalid-feedback">
                                {{ $errors->first('district') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="upazila_id">{{ trans('cruds.generalInfo.fields.upazila') }}</label>
                            <select class="form-control select2" name="upazila_id" id="upazila_id" required>
                                @foreach($upazilas as $id => $entry)
                                <option value="{{ $id }}" {{ old('upazila_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('upazila'))
                            <div class="invalid-feedback">
                                {{ $errors->first('upazila') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="union_id">{{ trans('cruds.generalInfo.fields.union') }}</label>
                            <select class="form-control select2" name="union_id" id="union_id" required>
                                @foreach($unions as $id => $entry)
                                <option value="{{ $id }}" {{ old('union_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('union'))
                            <div class="invalid-feedback">
                                {{ $errors->first('union') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.union_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="village">{{ trans('cruds.generalInfo.fields.village') }}</label>
                            <input class="form-control" type="text" name="village" id="village" value="{{ old('village', '') }}" required>
                            @if($errors->has('village'))
                            <div class="invalid-feedback">
                                {{ $errors->first('village') }}
                            </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.generalInfo.fields.village_helper') }}</span>
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