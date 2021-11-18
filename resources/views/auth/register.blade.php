@extends('layouts.app')
@section('styles')

<style>
    fieldset.border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }


    legend.border {
        width: inherit;
        padding: 0 10px;
        border-bottom: none;
        background: #060a6b;
        color: #ffffff;
    }


    .panel-default>.panel-heading {
        color: #fffcfc;
        background-color: #2A1562 !important;
        border-color: #ee1616;
        font-size: 20px;
        text-align: center;
    }

    .required:after {
        content: " *";
        color: red;
    }

    .header-note {

        color: red;
        font-weight: bolder;
    }

    .highlight {

        background-color: #ff4719;
        -webkit-transition: width 0.25s ease-in-out,
            background-color 0.25s ease-in-out;
        transition: width 0.25s ease-in-out, background-color 0.25s ease-in-out;
    }

    .select2 {
        width: 100% !important;
    }
</style>
@endsection


@section('content')

<!-- My code  -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style=" 
                color:green;">

                <div class="panel-heading"> ভর্তি সহায়তা সিস্টেমের ব্যবহারকারী নিবন্ধন ফরম
                </div>
                <div class="panel-body">
                    <p class="header-note"> [*] চিহ্নিত ঘরগুলো অবশ্যই পূরণ করতে হবে। সকল তথ্য ইউনিকোড বাংলায় পূরণ করুন। </p>
                    <form id="myform" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <fieldset class="border">
                            <legend class="border">
                                ব্যবহারকারী নিবন্ধন তথ্য ছক
                            </legend>
                            <div class=" form-row">
                                <p>লগইন করার জন্য ব্যবহারকারীর নামঃ <span id="user_id"></span></p>
                                <div class="col col-md-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                    <label class="required" for="name">{{ trans('global.user_name') }}</label>
                                    <input type="text" id="user_name" name="user_name" class="form-control" required placeholder="{{ trans('global.user_name') }}" value="{{ old('user_name', null) }}">
                                    @if($errors->has('user_name'))
                                    <span class="help-block" role="alert">{{ $errors->first('user_name') }}</span>
                                    @endif
                                    <span class="help-block"> </span>
                                </div>


                                <div class="col col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="required" for="name">{{ trans('global.name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" required autofocus placeholder="{{ trans('global.name') }}" value="{{ old('name', null) }}">

                                    @if($errors->has('name'))
                                    <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                                    @endif
                                    <span class="help-block"> </span>
                                </div>


                                <div class="col-md-6 {{ $errors->has('brid') ? ' has-error' : '' }}">
                                    <label class="required" for="brid">{{ trans('global.brid') }}</label>
                                    <!-- <input class="form-control" type="text" name="brid" required autofocus placeholder="{{ trans('global.brid') }}" value="{{ old('brid', null) }}"> -->
                                    <input class="form-control" type="text" name="brid" id="brid" value="{{ old('brid', '') }}" minlength="17" pattern="(.){17,17}" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 " onKeyDown="if (this.value.length==17 && event.keyCode!=8) return false" placeholder="১৭ ডিজিটের জন্ম সনদ নম্বর দিন " required>
                                    @if($errors->has('brid'))
                                    <span class="help-block" role="alert">{{ $errors->first('brid') }}</span>
                                    @endif
                                    <span class="help-block"> </span>
                                </div>

                                <div class="col-md-6 {{ $errors->has('dob') ? ' has-error' : '' }}">
                                    <label class="required" for="dob">{{ trans('global.dob') }}</label>
                                    <input class="form-control date" pattern="\d{1,2}/\d{1,2}/\d{4}" type="date" name="dob" id="dob" value="{{ old('dob') }}" placeholder="দিন-মাস-বছর" required>
                                    @if($errors->has('dob'))
                                    <span class="help-block" role="alert">{{ $errors->first('dob') }}</span>
                                    @endif
                                    <span class="help-block"> </span>
                                </div>


                                <div class="col-md-6 {{ $errors->has('division') ? 'has-error' : '' }}">
                                    <label class="required" for="division_id">{{ trans('cruds.generalInfo.fields.division') }}</label>
                                    <select class="form-control select2" name="division_id" id="division_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('division'))
                                    <span class="help-block" role="alert">{{ $errors->first('division') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.division_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('district') ? 'has-error' : '' }}">
                                    <label class="required" for="district_id">{{ trans('cruds.generalInfo.fields.district') }}</label>
                                    <select class="form-control select2" name="district_id" id="district_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('district'))
                                    <span class="help-block" role="alert">{{ $errors->first('district') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.district_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('upazila') ? 'has-error' : '' }}">
                                    <label class="required" for="upazila_id">{{ trans('cruds.generalInfo.fields.upazila') }}</label>
                                    <select class="form-control select2" name="upazila_id" id="upazila_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('upazila'))
                                    <span class="help-block" role="alert">{{ $errors->first('upazila') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.upazila_helper') }}</span>
                                </div>
                                <div class="col-md-6 {{ $errors->has('union') ? 'has-error' : '' }}">
                                    <label class="required" for="union_id">{{ trans('cruds.generalInfo.fields.union') }}</label>
                                    <select class="form-control select2" name="union_id" id="union_id" required>
                                        <option id="nullValueOption" value='' selected='selected'> {{trans('global.pleaseSelect')}}</option>
                                    </select>
                                    @if($errors->has('union'))
                                    <span class="help-block" role="alert">{{ $errors->first('union') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.generalInfo.fields.union_helper') }}</span>
                                </div>

                                <div class="col col-md-6  {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">{{ trans('global.login_email') }}</label>
                                    <input type="email" name="email" class="form-control" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                                    @if($errors->has('email'))
                                    <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                                    @endif
                                    <span class="help-block"> </span>
                                </div>

                                <div class="col col-md-6{{ $errors->has('user_contact') ? ' has-error' : '' }}">
                                    <label class="required" for=" user_contact">{{ trans('global.user_contact') }}</label>
                                    <input type="number" name="user_contact" class="form-control" onsubmit="if(this.value.length==11) return false;" required placeholder="{{ trans('global.user_contact') }}" value="{{ old('user_contact', null) }}">
                                    @if($errors->has('user_contact'))
                                    <span class="help-block" role="alert">{{ $errors->first('user_contact') }}</span>
                                    @endif
                                    <span class="help-block"> </span>
                                </div>




                                <div class="col col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="required" for="password">{{ trans('global.login_password') }}</label>
                                    <input type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">
                                    @if($errors->has('password'))
                                    <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                                    @endif

                                </div>
                                <div class="col-md-6 ">
                                    <label class="required" for="password_confirmation">{{ trans('global.login_password_confirmation') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                                </div>

                                <span class="help-block"> &nbsp; <br></span>
                                <div class="col col-md-3">
                                    <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                                            &#x21bb;
                                        </button>

                                    </div>
                                </div>
                                <div class="col col-md-9   {{ $errors->has('captcha') ? ' has-error' : '' }}">
                                    <input id="captcha" type="text" class="form-control" placeholder="{{ trans('global.Enter_Captcha') }}" name="captcha">
                                    @if($errors->has('captcha'))
                                    <span class="help-block" role="alert">{{ $errors->first('captcha') }}</span>
                                    @endif
                                </div>


                                <span class="help-block"> &nbsp; <br></span>
                                <div class="col-xs-8">
                                    <br />
                                </div>
                                <div class="col-md-12 pull-right">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <span style="font-size:  25px !important;"> &#10003; {{ trans('global.register') }}</span>
                                </div>


                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/registrationPage/locationFindAjax.js') }}"></script>

<script type="text/javascript">
    $('#reload').click(function() {
        $.ajax({
            type: 'GET',
            url: 'reloadCaptcha',
            success: function(data) {
                // console.log(data);
                $(".captcha span").html(data.captcha);
                $("#captcha").val("");

            }
        });
    });



    // $("#name").on("", function() {
    $(document).ready(function() {

        var currentdate = new Date();
        var userID =
            String(currentdate.getUTCFullYear()).padStart(2, '0') +
            String(currentdate.getUTCMonth()).padStart(2, '0') +
            String(currentdate.getDate()).padStart(2, '0') +
            String(currentdate.getHours()).padStart(2, '0') +
            String(currentdate.getMinutes()).padStart(2, '0') +
            String(currentdate.getSeconds()).padStart(2, '0') +
            String(currentdate.getMilliseconds()).padStart(2, '0') +
            String(Math.floor(Math.random() * 100));


        if ($("#user_name").val() == "") {
            $("#user_name").val(userID);
            $("#user_id").text(userID);
        }

        $("#user_name").prop("readonly", true);

        console.log(userID);


        // Division function ajax
        function getDivision() {
            var base_url = window.location.origin;


            let url = base_url + "/findDivName";

            console.log(url);
            let output = "";

            $.get(url)
                .always(function() {
                    $("#district_id").find("*").not("#nullValueOption").remove();
                    $("#upazila_id").find("*").not("#nullValueOption").remove();
                    $("#union_id").find("*").not("#nullValueOption").remove();
                })
                .done(function(data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        output +=
                            '<option value="' +
                            data[i].id +
                            '">' +
                            data[i].division_name +
                            "</option>";
                    }
                    $("#division_id").append(output);
                });
        }

        getDivision();
    });
</script>


@endsection