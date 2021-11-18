@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.users.update", [$user->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="username">{{ trans('cruds.user.fields.username') }}</label>
                            <input class="form-control" type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.username_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="guardian_name">{{ trans('cruds.user.fields.guardian_name') }}</label>
                            <input class="form-control" type="text" name="guardian_name" id="guardian_name" value="{{ old('guardian_name', $user->guardian_name) }}" required>
                            @if($errors->has('guardian_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('guardian_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.guardian_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="brid">{{ trans('cruds.user.fields.brid') }}</label>
                            <input class="form-control" type="text" name="brid" id="brid" value="{{ old('brid', $user->brid) }}">
                            @if($errors->has('brid'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brid') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.brid_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="eiin">{{ trans('cruds.user.fields.eiin') }}</label>
                            <input class="form-control" type="text" name="eiin" id="eiin" value="{{ old('eiin', $user->eiin) }}">
                            @if($errors->has('eiin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('eiin') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.eiin_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_contact">{{ trans('cruds.user.fields.user_contact') }}</label>
                            <input class="form-control" type="text" name="user_contact" id="user_contact" value="{{ old('user_contact', $user->user_contact) }}">
                            @if($errors->has('user_contact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_contact') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.user_contact_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="division_id">{{ trans('cruds.user.fields.division') }}</label>
                            <select class="form-control select2" name="division_id" id="division_id" required>
                                @foreach($divisions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $user->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('division'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('division') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.division_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="district_id">{{ trans('cruds.user.fields.district') }}</label>
                            <select class="form-control select2" name="district_id" id="district_id">
                                @foreach($districts as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $user->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('district'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('district') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.district_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upazila_id">{{ trans('cruds.user.fields.upazila') }}</label>
                            <select class="form-control select2" name="upazila_id" id="upazila_id">
                                @foreach($upazilas as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $user->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('upazila'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upazila') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.upazila_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="union_id">{{ trans('cruds.user.fields.union') }}</label>
                            <select class="form-control select2" name="union_id" id="union_id">
                                @foreach($unions as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('union_id') ? old('union_id') : $user->union->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('union'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('union') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.union_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_photo">{{ trans('cruds.user.fields.user_photo') }}</label>
                            <div class="needsclick dropzone" id="user_photo-dropzone">
                            </div>
                            @if($errors->has('user_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_photo') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.user_photo_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_signature">{{ trans('cruds.user.fields.user_signature') }}</label>
                            <div class="needsclick dropzone" id="user_signature-dropzone">
                            </div>
                            @if($errors->has('user_signature'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user_signature') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.user_signature_helper') }}</span>
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
    Dropzone.options.userPhotoDropzone = {
    url: '{{ route('frontend.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="user_photo"]').remove()
      $('form').append('<input type="hidden" name="user_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="user_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->user_photo)
      var file = {!! json_encode($user->user_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="user_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.userSignatureDropzone = {
    url: '{{ route('frontend.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="user_signature"]').remove()
      $('form').append('<input type="hidden" name="user_signature" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="user_signature"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->user_signature)
      var file = {!! json_encode($user->user_signature) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="user_signature" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection