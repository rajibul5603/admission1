@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.familyInfo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.family-infos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id_no">{{ trans('cruds.familyInfo.fields.user_id_no') }}</label>
                            <input class="form-control" type="text" name="user_id_no" id="user_id_no" value="{{ old('user_id_no', '') }}" required>
                            @if($errors->has('user_id_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_id_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.user_id_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="application_number_id">{{ trans('cruds.familyInfo.fields.application_number') }}</label>
                            <select class="form-control select2" name="application_number_id" id="application_number_id" required>
                                @foreach($application_numbers as $id => $entry)
                                    <option value="{{ $id }}" {{ old('application_number_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('application_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('application_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.application_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="familystatus_id">{{ trans('cruds.familyInfo.fields.familystatus') }}</label>
                            <select class="form-control select2" name="familystatus_id" id="familystatus_id" required>
                                @foreach($familystatuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('familystatus_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('familystatus'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('familystatus') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.familystatus_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="guardian_occupation_id">{{ trans('cruds.familyInfo.fields.guardian_occupation') }}</label>
                            <select class="form-control select2" name="guardian_occupation_id" id="guardian_occupation_id" required>
                                @foreach($guardian_occupations as $id => $entry)
                                    <option value="{{ $id }}" {{ old('guardian_occupation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('guardian_occupation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('guardian_occupation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_occupation_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.familyInfo.fields.guardian_education') }}</label>
                            <select class="form-control" name="guardian_education" id="guardian_education" required>
                                <option value disabled {{ old('guardian_education', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\FamilyInfo::GUARDIAN_EDUCATION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('guardian_education', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('guardian_education'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('guardian_education') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_education_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="guardian_land">{{ trans('cruds.familyInfo.fields.guardian_land') }}</label>
                            <input class="form-control" type="number" name="guardian_land" id="guardian_land" value="{{ old('guardian_land', '') }}" step="0.01" required max="100">
                            @if($errors->has('guardian_land'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('guardian_land') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_land_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="guardian_annual_income">{{ trans('cruds.familyInfo.fields.guardian_annual_income') }}</label>
                            <input class="form-control" type="number" name="guardian_annual_income" id="guardian_annual_income" value="{{ old('guardian_annual_income', '') }}" step="0.01" required>
                            @if($errors->has('guardian_annual_income'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('guardian_annual_income') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.guardian_annual_income_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="family_member">{{ trans('cruds.familyInfo.fields.family_member') }}</label>
                            <input class="form-control" type="number" name="family_member" id="family_member" value="{{ old('family_member', '') }}" step="1">
                            @if($errors->has('family_member'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('family_member') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyInfo.fields.family_member_helper') }}</span>
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