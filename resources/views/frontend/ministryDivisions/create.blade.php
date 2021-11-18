@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.ministryDivision.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.ministry-divisions.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="ministry_name">{{ trans('cruds.ministryDivision.fields.ministry_name') }}</label>
                            <input class="form-control" type="text" name="ministry_name" id="ministry_name" value="{{ old('ministry_name', '') }}" required>
                            @if($errors->has('ministry_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ministry_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ministryDivision.fields.ministry_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="division_name">{{ trans('cruds.ministryDivision.fields.division_name') }}</label>
                            <input class="form-control" type="text" name="division_name" id="division_name" value="{{ old('division_name', '') }}">
                            @if($errors->has('division_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ministryDivision.fields.division_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="checkbox" name="active" id="active" value="1" required {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                                <label class="required" for="active">{{ trans('cruds.ministryDivision.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.ministryDivision.fields.active_helper') }}</span>
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