@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.examVersion.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.exam-versions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="exam_version_name">{{ trans('cruds.examVersion.fields.exam_version_name') }}</label>
                            <input class="form-control" type="text" name="exam_version_name" id="exam_version_name" value="{{ old('exam_version_name', '') }}">
                            @if($errors->has('exam_version_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('exam_version_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.examVersion.fields.exam_version_name_helper') }}</span>
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