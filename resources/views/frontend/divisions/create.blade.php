@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.division.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.divisions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="division_name">{{ trans('cruds.division.fields.division_name') }}</label>
                            <input class="form-control" type="text" name="division_name" id="division_name" value="{{ old('division_name', '') }}" required>
                            @if($errors->has('division_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.division.fields.division_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="division_name_en">{{ trans('cruds.division.fields.division_name_en') }}</label>
                            <input class="form-control" type="text" name="division_name_en" id="division_name_en" value="{{ old('division_name_en', '') }}">
                            @if($errors->has('division_name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division_name_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.division.fields.division_name_en_helper') }}</span>
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