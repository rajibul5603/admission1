@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.thana.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.thanas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="district_name_id">{{ trans('cruds.thana.fields.district_name') }}</label>
                            <select class="form-control select2" name="district_name_id" id="district_name_id" required>
                                @foreach($district_names as $id => $entry)
                                    <option value="{{ $id }}" {{ old('district_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.thana.fields.district_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="thana_name">{{ trans('cruds.thana.fields.thana_name') }}</label>
                            <input class="form-control" type="text" name="thana_name" id="thana_name" value="{{ old('thana_name', '') }}" required>
                            @if($errors->has('thana_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('thana_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.thana.fields.thana_name_helper') }}</span>
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