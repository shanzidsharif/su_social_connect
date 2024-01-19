<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin-module') }}/images/brand/favicon.ico" />
    <!-- TITLE -->
    <title>Admin login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('assets/admin-module') }}/plugins/bootstrap/css/bootstrap.min.css"
        rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('assets/admin-module') }}/css/style.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin-module') }}/css/dark-style.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin-module') }}/css/transparent-style.css" rel="stylesheet">
    <link href="{{ asset('assets/admin-module') }}/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('assets/admin-module') }}/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/admin-module') }}/colors/color1.css" />
    <link href="{{asset('assets/admin-module')}}/css/toastr.min.css" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/admin-module') }}/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <a href="#"><img src="{{ asset('assets') }}/logo.png" class="header-brand-img"
                                height="100" alt=""></a>
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form class="login100-form validate-form" action="#" method="post">
                            @csrf
                            <span class="login100-form-title pb-5">
                                Admin Login
                            </span>
                            <div class="panel panel-primary">
                                <div class="panel-body tabs-menu-body p-0 pt-5">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <div class="wrap-input100 validate-input input-group"
                                                data-bs-validate="Valid email is required: ex@abc.xyz">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="email"
                                                    name="email" value="{{ old('email') }}" placeholder="Email">
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="password"
                                                    name="password" placeholder="Password">
                                            </div>
                                            <div class="container-login100-form-btn">
                                                <button type="submit" class="login100-form-btn btn-primary">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{ asset('assets/admin-module') }}/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('assets/admin-module') }}/plugins/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('assets/admin-module') }}/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{ asset('assets/admin-module') }}/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="{{ asset('assets/admin-module') }}/js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ asset('assets/admin-module') }}/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="{{ asset('assets/admin-module') }}/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('assets/admin-module') }}/js/custom.js"></script>
    <script src="{{asset('assets/admin-module')}}/custom-js/toastr.min.js"></script>
{{--toastr--}}
<script>
    "use strict";
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif

    @if(session()->has('success'))
    toastr.success('{{ session('success') }}');
    @endif
</script>


</body>

</html>
