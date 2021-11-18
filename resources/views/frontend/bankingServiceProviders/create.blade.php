@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.bankingServiceProvider.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.banking-service-providers.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.bankingServiceProvider.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="bank_type_id">{{ trans('cruds.bankingServiceProvider.fields.bank_type') }}</label>
                            <select class="form-control select2" name="bank_type_id" id="bank_type_id" required>
                                @foreach($bank_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('bank_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_type') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.bank_type_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="head_office">{{ trans('cruds.bankingServiceProvider.fields.head_office') }}</label>
                            <input class="form-control" type="text" name="head_office" id="head_office" value="{{ old('head_office', '') }}">
                            @if($errors->has('head_office'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('head_office') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.head_office_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="known_as">{{ trans('cruds.bankingServiceProvider.fields.known_as') }}</label>
                            <input class="form-control" type="text" name="known_as" id="known_as" value="{{ old('known_as', '') }}" required>
                            @if($errors->has('known_as'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('known_as') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.known_as_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="swift_code">{{ trans('cruds.bankingServiceProvider.fields.swift_code') }}</label>
                            <input class="form-control" type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', '') }}">
                            @if($errors->has('swift_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('swift_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.swift_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.bankingServiceProvider.fields.category') }}</label>
                            <select class="form-control" name="category" id="category">
                                <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\BankingServiceProvider::CATEGORY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', 'NULL') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="website">{{ trans('cruds.bankingServiceProvider.fields.website') }}</label>
                            <input class="form-control" type="text" name="website" id="website" value="{{ old('website', '') }}">
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankingServiceProvider.fields.website_helper') }}</span>
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