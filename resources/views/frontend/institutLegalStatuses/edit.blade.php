@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.institutLegalStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.institut-legal-statuses.update", [$institutLegalStatus->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="institute_legal_status">{{ trans('cruds.institutLegalStatus.fields.institute_legal_status') }}</label>
                            <input class="form-control" type="text" name="institute_legal_status" id="institute_legal_status" value="{{ old('institute_legal_status', $institutLegalStatus->institute_legal_status) }}">
                            @if($errors->has('institute_legal_status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('institute_legal_status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.institutLegalStatus.fields.institute_legal_status_helper') }}</span>
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