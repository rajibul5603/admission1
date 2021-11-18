@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.union.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.unions.update", [$union->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="upazila_id">{{ trans('cruds.union.fields.upazila') }}</label>
                            <select class="form-control select2" name="upazila_id" id="upazila_id">
                                @foreach($upazilas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $union->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.union.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="union_name">{{ trans('cruds.union.fields.union_name') }}</label>
                            <input class="form-control" type="text" name="union_name" id="union_name" value="{{ old('union_name', $union->union_name) }}" required>
                            @if($errors->has('union_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('union_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.union.fields.union_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="union_name_en">{{ trans('cruds.union.fields.union_name_en') }}</label>
                            <input class="form-control" type="text" name="union_name_en" id="union_name_en" value="{{ old('union_name_en', $union->union_name_en) }}">
                            @if($errors->has('union_name_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('union_name_en') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.union.fields.union_name_en_helper') }}</span>
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