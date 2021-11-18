@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.academicYear.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.academic-years.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="academic_year">{{ trans('cruds.academicYear.fields.academic_year') }}</label>
                            <input class="form-control" type="text" name="academic_year" id="academic_year" value="{{ old('academic_year', '') }}" required>
                            @if($errors->has('academic_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('academic_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicYear.fields.academic_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="start_year">{{ trans('cruds.academicYear.fields.start_year') }}</label>
                            <input class="form-control" type="text" name="start_year" id="start_year" value="{{ old('start_year', '') }}">
                            @if($errors->has('start_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('start_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicYear.fields.start_year_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="end_year">{{ trans('cruds.academicYear.fields.end_year') }}</label>
                            <input class="form-control" type="text" name="end_year" id="end_year" value="{{ old('end_year', '') }}">
                            @if($errors->has('end_year'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('end_year') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.academicYear.fields.end_year_helper') }}</span>
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