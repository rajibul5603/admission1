@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.instituteType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.institute-types.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="institute_type">{{ trans('cruds.instituteType.fields.institute_type') }}</label>
                            <input class="form-control" type="text" name="institute_type" id="institute_type" value="{{ old('institute_type', '') }}" required>
                            @if($errors->has('institute_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.instituteType.fields.institute_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="active" id="active" value="1" required {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                                <label class="required" for="active">{{ trans('cruds.instituteType.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.instituteType.fields.active_helper') }}</span>
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