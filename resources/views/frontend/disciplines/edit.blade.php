@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.discipline.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.disciplines.update", [$discipline->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="discipline_name">{{ trans('cruds.discipline.fields.discipline_name') }}</label>
                            <input class="form-control" type="text" name="discipline_name" id="discipline_name" value="{{ old('discipline_name', $discipline->discipline_name) }}" required>
                            @if($errors->has('discipline_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('discipline_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.discipline.fields.discipline_name_helper') }}</span>
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