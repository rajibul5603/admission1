@extends('layouts.app')
@section('content')



<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
    </div>
    <!-- <div class="login-box-body"> -->
    <div class="panel panel-default">
        <div class="panel-body">

            <p class="login-box-msg">
                Resend Verification Code
            </p>
            <form method="POST" action="{{ route('RequestForResendCode') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class=" col-md-6 {{ $errors->has('brid') ? ' has-error' : '' }}">
                        <input type="text" name="brid" class="form-control" required autofocus placeholder="{{ trans('global.brid') }}" value="{{ old('guardian_name', null) }}">
                        @if($errors->has('brid'))
                        <p class="help-block">
                            {{ $errors->first('brid') }}
                        </p>
                        @endif
                    </div>

                    <div class="col-md-6 {{ $errors->has('user_contact') ? ' has-error' : '' }}">
                        <input type="number" name="user_contact" class="form-control" onsubmit="if(this.value.length==11) return false;" required placeholder="{{ trans('global.user_contact') }}" value="{{ old('user_contact', null) }}">
                        @if($errors->has('user_contact'))
                        <p class="help-block">
                            {{ $errors->first('user_contact') }}
                        </p>
                        @endif
                    </div>

                    <div class="col-md-12">
                        &nbsp;
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Resend Code
                        </button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>

@endsection