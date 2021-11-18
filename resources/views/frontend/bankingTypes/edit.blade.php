@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bankingType.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.banking-types.update", [$bankingType->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="banking_type">{{ trans('cruds.bankingType.fields.banking_type') }}</label>
                            <input class="form-control" type="text" name="banking_type" id="banking_type" value="{{ old('banking_type', $bankingType->banking_type) }}">
                            @if($errors->has('banking_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('banking_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingType.fields.banking_type_helper') }}</span>
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