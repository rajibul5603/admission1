@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.selection.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.selections.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="app_number">{{ trans('cruds.selection.fields.app_number') }}</label>
                            <input class="form-control" type="text" name="app_number" id="app_number" value="{{ old('app_number', '') }}" required>
                            @if($errors->has('app_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('app_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.app_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="user">{{ trans('cruds.selection.fields.user') }}</label>
                            <input class="form-control" type="text" name="user" id="user" value="{{ old('user', '') }}" required>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ih_comments">{{ trans('cruds.selection.fields.ih_comments') }}</label>
                            <input class="form-control" type="text" name="ih_comments" id="ih_comments" value="{{ old('ih_comments', '') }}" required>
                            @if($errors->has('ih_comments'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ih_comments') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.ih_comments_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ih_approval">{{ trans('cruds.selection.fields.ih_approval') }}</label>
                            <input class="form-control" type="text" name="ih_approval" id="ih_approval" value="{{ old('ih_approval', '') }}" required>
                            @if($errors->has('ih_approval'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ih_approval') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.ih_approval_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="ih_submission">{{ trans('cruds.selection.fields.ih_submission') }}</label>
                            <input class="form-control" type="text" name="ih_submission" id="ih_submission" value="{{ old('ih_submission', '') }}" required>
                            @if($errors->has('ih_submission'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ih_submission') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.ih_submission_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.selection.fields.useo_approval') }}</label>
                            <select class="form-control" name="useo_approval" id="useo_approval" required>
                                <option value disabled {{ old('useo_approval', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Selection::USEO_APPROVAL_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('useo_approval', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('useo_approval'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('useo_approval') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.useo_approval_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="useo_submission">{{ trans('cruds.selection.fields.useo_submission') }}</label>
                            <input class="form-control" type="text" name="useo_submission" id="useo_submission" value="{{ old('useo_submission', '') }}" required>
                            @if($errors->has('useo_submission'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('useo_submission') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.useo_submission_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="pmeat_comments">{{ trans('cruds.selection.fields.pmeat_comments') }}</label>
                            <input class="form-control" type="text" name="pmeat_comments" id="pmeat_comments" value="{{ old('pmeat_comments', '') }}" required>
                            @if($errors->has('pmeat_comments'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pmeat_comments') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.pmeat_comments_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.selection.fields.pmeat_approval') }}</label>
                            <select class="form-control" name="pmeat_approval" id="pmeat_approval" required>
                                <option value disabled {{ old('pmeat_approval', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Selection::PMEAT_APPROVAL_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('pmeat_approval', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pmeat_approval'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pmeat_approval') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.pmeat_approval_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="eiin">{{ trans('cruds.selection.fields.eiin') }}</label>
                            <input class="form-control" type="text" name="eiin" id="eiin" value="{{ old('eiin', '') }}" required>
                            @if($errors->has('eiin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('eiin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.eiin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="division">{{ trans('cruds.selection.fields.division') }}</label>
                            <input class="form-control" type="text" name="division" id="division" value="{{ old('division', '') }}" required>
                            @if($errors->has('division'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="district">{{ trans('cruds.selection.fields.district') }}</label>
                            <input class="form-control" type="text" name="district" id="district" value="{{ old('district', '') }}" required>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="upazila">{{ trans('cruds.selection.fields.upazila') }}</label>
                            <input class="form-control" type="text" name="upazila" id="upazila" value="{{ old('upazila', '') }}" required>
                            @if($errors->has('upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.selection.fields.upazila_helper') }}</span>
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