@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.department.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.departments.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="department_name">{{ trans('cruds.department.fields.department_name') }}</label>
                            <input class="form-control" type="text" name="department_name" id="department_name" value="{{ old('department_name', '') }}" required>
                            @if($errors->has('department_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('department_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.department.fields.department_name_helper') }}</span>
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