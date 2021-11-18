@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.applicationTracking.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.application-trackings.update", [$applicationTracking->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="user_id_no_id">{{ trans('cruds.applicationTracking.fields.user_id_no') }}</label>
                            <select class="form-control select2" name="user_id_no_id" id="user_id_no_id" required>
                                @foreach($user_id_nos as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('user_id_no_id') ? old('user_id_no_id') : $applicationTracking->user_id_no->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user_id_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_id_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.user_id_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="application_no">{{ trans('cruds.applicationTracking.fields.application_no') }}</label>
                            <input class="form-control" type="text" name="application_no" id="application_no" value="{{ old('application_no', $applicationTracking->application_no) }}" required>
                            @if($errors->has('application_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('application_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.application_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_completed" value="0">
                                <input type="checkbox" name="is_completed" id="is_completed" value="1" {{ $applicationTracking->is_completed || old('is_completed', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_completed">{{ trans('cruds.applicationTracking.fields.is_completed') }}</label>
                            </div>
                            @if($errors->has('is_completed'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_completed') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.is_completed_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="is_submitted" value="0">
                                <input type="checkbox" name="is_submitted" id="is_submitted" value="1" {{ $applicationTracking->is_submitted || old('is_submitted', 0) === 1 ? 'checked' : '' }}>
                                <label for="is_submitted">{{ trans('cruds.applicationTracking.fields.is_submitted') }}</label>
                            </div>
                            @if($errors->has('is_submitted'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('is_submitted') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.is_submitted_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="ih_seen" value="0">
                                <input type="checkbox" name="ih_seen" id="ih_seen" value="1" {{ $applicationTracking->ih_seen || old('ih_seen', 0) === 1 ? 'checked' : '' }}>
                                <label for="ih_seen">{{ trans('cruds.applicationTracking.fields.ih_seen') }}</label>
                            </div>
                            @if($errors->has('ih_seen'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ih_seen') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.ih_seen_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="ih_approve" value="0">
                                <input type="checkbox" name="ih_approve" id="ih_approve" value="1" {{ $applicationTracking->ih_approve || old('ih_approve', 0) === 1 ? 'checked' : '' }}>
                                <label for="ih_approve">{{ trans('cruds.applicationTracking.fields.ih_approve') }}</label>
                            </div>
                            @if($errors->has('ih_approve'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ih_approve') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.ih_approve_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="ih_forwarded" value="0">
                                <input type="checkbox" name="ih_forwarded" id="ih_forwarded" value="1" {{ $applicationTracking->ih_forwarded || old('ih_forwarded', 0) === 1 ? 'checked' : '' }}>
                                <label for="ih_forwarded">{{ trans('cruds.applicationTracking.fields.ih_forwarded') }}</label>
                            </div>
                            @if($errors->has('ih_forwarded'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ih_forwarded') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.ih_forwarded_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="useo_forwarded" value="0">
                                <input type="checkbox" name="useo_forwarded" id="useo_forwarded" value="1" {{ $applicationTracking->useo_forwarded || old('useo_forwarded', 0) === 1 ? 'checked' : '' }}>
                                <label for="useo_forwarded">{{ trans('cruds.applicationTracking.fields.useo_forwarded') }}</label>
                            </div>
                            @if($errors->has('useo_forwarded'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('useo_forwarded') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.useo_forwarded_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="pmeat_accepted" value="0">
                                <input type="checkbox" name="pmeat_accepted" id="pmeat_accepted" value="1" {{ $applicationTracking->pmeat_accepted || old('pmeat_accepted', 0) === 1 ? 'checked' : '' }}>
                                <label for="pmeat_accepted">{{ trans('cruds.applicationTracking.fields.pmeat_accepted') }}</label>
                            </div>
                            @if($errors->has('pmeat_accepted'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pmeat_accepted') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.pmeat_accepted_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="pmeat_selected" value="0">
                                <input type="checkbox" name="pmeat_selected" id="pmeat_selected" value="1" {{ $applicationTracking->pmeat_selected || old('pmeat_selected', 0) === 1 ? 'checked' : '' }}>
                                <label for="pmeat_selected">{{ trans('cruds.applicationTracking.fields.pmeat_selected') }}</label>
                            </div>
                            @if($errors->has('pmeat_selected'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pmeat_selected') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.pmeat_selected_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="rejection_reaseon">{{ trans('cruds.applicationTracking.fields.rejection_reaseon') }}</label>
                            <input class="form-control" type="text" name="rejection_reaseon" id="rejection_reaseon" value="{{ old('rejection_reaseon', $applicationTracking->rejection_reaseon) }}">
                            @if($errors->has('rejection_reaseon'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rejection_reaseon') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.applicationTracking.fields.rejection_reaseon_helper') }}</span>
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