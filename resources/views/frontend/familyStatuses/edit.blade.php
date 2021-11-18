@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.familyStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.family-statuses.update", [$familyStatus->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="status_name">{{ trans('cruds.familyStatus.fields.status_name') }}</label>
                            <input class="form-control" type="text" name="status_name" id="status_name" value="{{ old('status_name', $familyStatus->status_name) }}" required>
                            @if($errors->has('status_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.familyStatus.fields.status_name_helper') }}</span>
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