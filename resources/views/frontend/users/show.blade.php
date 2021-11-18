@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.username') }}
                                    </th>
                                    <td>
                                        {{ $user->username }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.guardian_name') }}
                                    </th>
                                    <td>
                                        {{ $user->guardian_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.brid') }}
                                    </th>
                                    <td>
                                        {{ $user->brid }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.eiin') }}
                                    </th>
                                    <td>
                                        {{ $user->eiin }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.user_contact') }}
                                    </th>
                                    <td>
                                        {{ $user->user_contact }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.division') }}
                                    </th>
                                    <td>
                                        {{ $user->division->division_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.district') }}
                                    </th>
                                    <td>
                                        {{ $user->district->district_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.roles') }}
                                    </th>
                                    <td>
                                        @foreach($user->roles as $key => $roles)
                                            <span class="label label-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.upazila') }}
                                    </th>
                                    <td>
                                        {{ $user->upazila->upazila_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.union') }}
                                    </th>
                                    <td>
                                        {{ $user->union->union_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.user_photo') }}
                                    </th>
                                    <td>
                                        @if($user->user_photo)
                                            <a href="{{ $user->user_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->user_photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.user_signature') }}
                                    </th>
                                    <td>
                                        @if($user->user_signature)
                                            <a href="{{ $user->user_signature->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->user_signature->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.users.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection