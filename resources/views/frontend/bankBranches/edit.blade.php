@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.bankBranch.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.bank-branches.update", [$bankBranch->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="bank_name_id">{{ trans('cruds.bankBranch.fields.bank_name') }}</label>
                            <select class="form-control select2" name="bank_name_id" id="bank_name_id" required>
                                @foreach($bank_names as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('bank_name_id') ? old('bank_name_id') : $bankBranch->bank_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.bank_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="branch_name">{{ trans('cruds.bankBranch.fields.branch_name') }}</label>
                            <input class="form-control" type="text" name="branch_name" id="branch_name" value="{{ old('branch_name', $bankBranch->branch_name) }}" required>
                            @if($errors->has('branch_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.branch_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="branch_code">{{ trans('cruds.bankBranch.fields.branch_code') }}</label>
                            <input class="form-control" type="text" name="branch_code" id="branch_code" value="{{ old('branch_code', $bankBranch->branch_code) }}">
                            @if($errors->has('branch_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('branch_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.branch_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="district_id">{{ trans('cruds.bankBranch.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id" required>
                                @foreach($districts as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $bankBranch->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upazila_id">{{ trans('cruds.bankBranch.fields.upazila') }}</label>
                            <select class="form-control select2" name="upazila_id" id="upazila_id">
                                @foreach($upazilas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $bankBranch->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="routing_number">{{ trans('cruds.bankBranch.fields.routing_number') }}</label>
                            <input class="form-control" type="number" name="routing_number" id="routing_number" value="{{ old('routing_number', $bankBranch->routing_number) }}" step="1" required>
                            @if($errors->has('routing_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('routing_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.routing_number_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('cruds.bankBranch.fields.address') }}</label>
                            <textarea class="form-control ckeditor" name="address" id="address">{!! old('address', $bankBranch->address) !!}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="swift_code">{{ trans('cruds.bankBranch.fields.swift_code') }}</label>
                            <input class="form-control" type="text" name="swift_code" id="swift_code" value="{{ old('swift_code', $bankBranch->swift_code) }}">
                            @if($errors->has('swift_code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('swift_code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.swift_code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.bankBranch.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $bankBranch->email) }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="manager_name">{{ trans('cruds.bankBranch.fields.manager_name') }}</label>
                            <input class="form-control" type="text" name="manager_name" id="manager_name" value="{{ old('manager_name', $bankBranch->manager_name) }}">
                            @if($errors->has('manager_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('manager_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.manager_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('cruds.bankBranch.fields.phone') }}</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone', $bankBranch->phone) }}">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile">{{ trans('cruds.bankBranch.fields.mobile') }}</label>
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{ old('mobile', $bankBranch->mobile) }}">
                            @if($errors->has('mobile'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mobile') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.mobile_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ $bankBranch->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                <label for="active">{{ trans('cruds.bankBranch.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('active') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankBranch.fields.active_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.bank-branches.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $bankBranch->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection