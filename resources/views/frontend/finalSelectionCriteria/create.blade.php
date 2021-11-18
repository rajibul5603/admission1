@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.finalSelectionCriterion.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.final-selection-criteria.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="final_criteria_name">{{ trans('cruds.finalSelectionCriterion.fields.final_criteria_name') }}</label>
                            <input class="form-control" type="text" name="final_criteria_name" id="final_criteria_name" value="{{ old('final_criteria_name', '') }}" required>
                            @if($errors->has('final_criteria_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('final_criteria_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.finalSelectionCriterion.fields.final_criteria_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="cirular_id">{{ trans('cruds.finalSelectionCriterion.fields.cirular') }}</label>
                            <select class="form-control select2" name="cirular_id" id="cirular_id" required>
                                @foreach($cirulars as $id => $entry)
                                    <option value="{{ $id }}" {{ old('cirular_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cirular'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('cirular') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.finalSelectionCriterion.fields.cirular_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="division_id">{{ trans('cruds.finalSelectionCriterion.fields.division') }}</label>
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
                            <span class="help-block">{{ trans('cruds.finalSelectionCriterion.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="district_id">{{ trans('cruds.finalSelectionCriterion.fields.district') }}</label>
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
                            <span class="help-block">{{ trans('cruds.finalSelectionCriterion.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="upazila_id">{{ trans('cruds.finalSelectionCriterion.fields.upazila') }}</label>
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
                            <span class="help-block">{{ trans('cruds.finalSelectionCriterion.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="active" id="active" value="1" required {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                                <label class="required" for="active">{{ trans('cruds.finalSelectionCriterion.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.finalSelectionCriterion.fields.active_helper') }}</span>
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