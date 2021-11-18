@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.upazila.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.upazilas.update", [$upazila->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="district_id">{{ trans('cruds.upazila.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id">
                                @foreach($districts as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $upazila->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.upazila.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upazila_name">{{ trans('cruds.upazila.fields.upazila_name') }}</label>
                            <input class="form-control" type="text" name="upazila_name" id="upazila_name" value="{{ old('upazila_name', $upazila->upazila_name) }}">
                            @if($errors->has('upazila_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.upazila.fields.upazila_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upazila_name_en">{{ trans('cruds.upazila.fields.upazila_name_en') }}</label>
                            <input class="form-control" type="text" name="upazila_name_en" id="upazila_name_en" value="{{ old('upazila_name_en', $upazila->upazila_name_en) }}">
                            @if($errors->has('upazila_name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila_name_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.upazila.fields.upazila_name_en_helper') }}</span>
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