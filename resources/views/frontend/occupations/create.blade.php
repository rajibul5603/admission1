@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.occupation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.occupations.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="occupation_name">{{ trans('cruds.occupation.fields.occupation_name') }}</label>
                            <input class="form-control" type="text" name="occupation_name" id="occupation_name" value="{{ old('occupation_name', '') }}">
                            @if($errors->has('occupation_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('occupation_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.occupation.fields.occupation_name_helper') }}</span>
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