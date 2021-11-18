<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('panel.site_title') }}</title>


    <meta name="description" content="PMEAT">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="icon" href="{{ asset('public/images/favicon/favicon.ico') }}" sizes="16x16" />

    <!-- Icons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <!-- Main styles for this application -->
    <link href="{{asset('css/login-style.css')}}" rel="stylesheet">

    <style>
        @font-face {
            font-family: nikosh;
            src: url('{{ asset("fonts/Nikosh.tff") }}');
        }

        body {
            font-family: "nikosh" !important;
            font-size: 20px;
        }
    </style>


</head>

<body class="app flex-row align-items-center login_body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="org_logo text-center">
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public/images/aams-logo-big.png')}}" class="brand-logo" alt="PMEAT Logo"></a>

                </div>
                @if(session('message'))
                <div class="alert alert-sucess" role="alert">
                    {{ session('message') }}
                </div>
                @endif

                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>লগইন</h1>
                            <p class="text-muted">আপনার অ্যাকাউন্টে লগইন করুন</p>

                            @if($errors->has('email'))
                            <div class="alert alert-danger" role="alert">

                                {{ $errors->first('email') }}
                            </div>
                            @endif




                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="input-group mb-3">
                                    <span class="input-group-addon"><strong class="fa fa-user"></strong></span>
                                    <label for="email" hidden>Email/BRID</label>
                                    <!-- <input type="text" id="email" name="email" value="" class="form-control" required="" autofocus="" placeholder="ই-মেইল / মোবাইল নম্বর / ইউজারনেম  "> -->
                                    <input id="email" type="text" name="email" class="form-control" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }} / {{ trans('global.brid') }}" value="{{ old('email', null) }}">

                                </div>
                                <div class="input-group mb-4">
                                    <span class="input-group-addon"><strong class="fa fa-lock"></strong></span>
                                    <label for="pass_log_id" hidden>পাসওয়ার্ড</label>
                                    <!-- <input type="password" name="password" id="pass_log_id" class="form-control" placeholder="পাসওয়ার্ড" required="" data-toggle="password"> -->
                                    <input id="pass_log_id" type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">

                                    <span toggle="#password-field" class="input-group-addon"><strong class="fa fa-fw fa-eye field_icon toggle-password"></strong></span>

                                    @if($errors->has('password'))
                                    <p class="help-block">
                                        {{ $errors->first('password') }}
                                    </p>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-6 pt-1">
                                        <button type="submit" class="btn btn-primary btn_login px-4"> {{ trans('global.login') }}</button>
                                    </div>
                                    <div class="col-6 forgot_pass">
                                        @if(Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ trans('global.forgot_password') }}
                                        </a>
                                        <br>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div style="width:44%;" class="card bg_color text-white bg-primary py-5 "> -->
                    <div class="card bg_color text-white bg-primary p-4">
                        <div class="card-body text-center">
                            <div>
                                <h2>নিবন্ধন করুন</h2>
                                <p>যদি এই সিস্টেমে শিক্ষার্থী/ শিক্ষা প্রতিষ্ঠানপ্রধান/উপজেলা শিক্ষা কর্মকর্তা হিসেবে আপনার অ্যাকাউন্ট না থাকে তাহলে</p>

                                <a href="{{ route('register') }}" class="btn btn-primary active mt-3 nibondon_btn"> {{ trans('global.register') }} </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('css/login/jquery.min.js')}}"></script>
    <script src="{{asset('css/login/popper.min.js')}}"></script>
    <script src="{{asset('css/login//bootstrap.min.js')}}"></script>
    <script>
        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#pass_log_id");
            input.attr('type') === 'password' ? input.attr('type', 'text') : input.attr('type', 'password')
        });
    </script>
</body>

</html>