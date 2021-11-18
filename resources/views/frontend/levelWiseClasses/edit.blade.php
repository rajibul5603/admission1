@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.levelWiseClass.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.level-wise-classes.update", [$levelWiseClass->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="class_name">{{ trans('cruds.levelWiseClass.fields.class_name') }}</label>
                            <input class="form-control" type="text" name="class_name" id="class_name" value="{{ old('class_name', $levelWiseClass->class_name) }}" required>
                            @if($errors->has('class_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('class_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.levelWiseClass.fields.class_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="academic_level_id">{{ trans('cruds.levelWiseClass.fields.academic_level') }}</label>
                            <select class="form-control select2" name="academic_level_id" id="academic_level_id">
                                @foreach($academic_levels as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('academic_level_id') ? old('academic_level_id') : $levelWiseClass->academic_level->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('academic_level'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('academic_level') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.levelWiseClass.fields.academic_level_helper') }}</span>
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