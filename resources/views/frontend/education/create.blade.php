@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.education.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.education.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.education.fields.degree') }}</label>
                            <select class="form-control" name="degree" id="degree" required>
                                <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Education::DEGREE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('degree', 'সিলেক্ট করুন') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('degree'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('degree') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.education.fields.degree_helper') }}</span>
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