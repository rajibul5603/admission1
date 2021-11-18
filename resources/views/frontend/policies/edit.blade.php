@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.policy.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.policies.update", [$policy->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="policy_name">{{ trans('cruds.policy.fields.policy_name') }}</label>
                            <input class="form-control" type="text" name="policy_name" id="policy_name" value="{{ old('policy_name', $policy->policy_name) }}" required>
                            @if($errors->has('policy_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('policy_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.policy.fields.policy_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.policy.fields.policy_year') }}</label>
                            <select class="form-control" name="policy_year" id="policy_year" required>
                                <option value disabled {{ old('policy_year', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Policy::POLICY_YEAR_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('policy_year', $policy->policy_year) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('policy_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('policy_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.policy.fields.policy_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="last_gpa">{{ trans('cruds.policy.fields.last_gpa') }}</label>
                            <input class="form-control" type="number" name="last_gpa" id="last_gpa" value="{{ old('last_gpa', $policy->last_gpa) }}" step="0.01" max="5">
                            @if($errors->has('last_gpa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_gpa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.policy.fields.last_gpa_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="max_annual_income">{{ trans('cruds.policy.fields.max_annual_income') }}</label>
                            <input class="form-control" type="number" name="max_annual_income" id="max_annual_income" value="{{ old('max_annual_income', $policy->max_annual_income) }}" step="0.01">
                            @if($errors->has('max_annual_income'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('max_annual_income') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.policy.fields.max_annual_income_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="active" id="active" value="1" {{ $policy->active || old('active', 0) === 1 ? 'checked' : '' }} required>
                                <label class="required" for="active">{{ trans('cruds.policy.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.policy.fields.active_helper') }}</span>
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