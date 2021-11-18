@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.academicLevel.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.academic-levels.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="level_name">{{ trans('cruds.academicLevel.fields.level_name') }}</label>
                            <input class="form-control" type="text" name="level_name" id="level_name" value="{{ old('level_name', '') }}" required>
                            @if($errors->has('level_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('level_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicLevel.fields.level_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="active" id="active" value="1" required {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                                <label class="required" for="active">{{ trans('cruds.academicLevel.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicLevel.fields.active_helper') }}</span>
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