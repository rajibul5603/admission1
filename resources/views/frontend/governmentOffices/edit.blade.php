@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.governmentOffice.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.government-offices.update", [$governmentOffice->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="ministry_name_id">{{ trans('cruds.governmentOffice.fields.ministry_name') }}</label>
                            <select class="form-control select2" name="ministry_name_id" id="ministry_name_id">
                                @foreach($ministry_names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('ministry_name_id') ? old('ministry_name_id') : $governmentOffice->ministry_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ministry_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ministry_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.governmentOffice.fields.ministry_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="govt_ogranization_name">{{ trans('cruds.governmentOffice.fields.govt_ogranization_name') }}</label>
                            <input class="form-control" type="text" name="govt_ogranization_name" id="govt_ogranization_name" value="{{ old('govt_ogranization_name', $governmentOffice->govt_ogranization_name) }}" required>
                            @if($errors->has('govt_ogranization_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('govt_ogranization_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.governmentOffice.fields.govt_ogranization_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ $governmentOffice->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                <label for="active">{{ trans('cruds.governmentOffice.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.governmentOffice.fields.active_helper') }}</span>
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