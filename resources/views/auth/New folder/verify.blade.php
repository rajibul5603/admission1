@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            Verify your Code
        </p>

        @if(session('message'))
        <p class="alert alert-info">
            {{ session('message') }}
        </p>
        @endif

        <form method="POST" action="{{ route('verify') }}">
            @csrf


            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <input id="code" type="number" name="code" class="form-control" required placeholder=" ">

                @if($errors->has('code'))
                <p class="help-block">
                    {{ $errors->first('code') }}
                </p>
                @endif
            </div>
            <div class="row">

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        Verify
                    </button>
                </div>
            </div>
        </form>

        <div class="card-footer">
            <a href="{{route('resendVerify')}}">Resend Code</a>
        </div>
    </div>
</div>
@endsection