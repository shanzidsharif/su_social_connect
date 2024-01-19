<!doctype html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/logo.png" />
        <title>@yield('page_title')</title>
        <link id="style" href="{{ asset('assets/admin-module') }}/plugins/bootstrap/css/bootstrap.min.css"
            rel="stylesheet" />
        <link href="{{ asset('assets/admin-module') }}/css/style.css" rel="stylesheet" />
        <link href="{{ asset('assets/admin-module') }}/css/dark-style.css" rel="stylesheet" />
        <link href="{{ asset('assets/admin-module') }}/css/transparent-style.css" rel="stylesheet">
        <link href="{{ asset('assets/admin-module') }}/css/skin-modes.css" rel="stylesheet" />
        <link href="{{ asset('assets/admin-module') }}/css/icons.css" rel="stylesheet" />
        <link id="theme" rel="stylesheet" type="text/css" media="all"
            href="{{ asset('assets/admin-module') }}/colors/color1.css" />

        <link href="{{ asset('assets/admin-module') }}/css/toastr.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="base-url" content="{{ url('/') }}">
        @stack('page_css')
        <style>
            #global-loader {
                background: transparent !important;
            }
        </style>
    </head>

    <body class="app sidebar-mini ltr light-mode">

        {{-- loader --}}
        <!-- GLOBAL-LOADER -->
        <div id="global-loader">
            <img src="{{ asset('assets/admin-module') }}/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOBAL-LOADER -->
        {{-- loader --}}

        <!-- PAGE -->
        <div class="page">
            <div class="page-main">

                {{-- header --}}
                @include('adminmodule::layouts.partials._header')
                {{-- header --}}

                {{-- sidebar --}}
                @include('adminmodule::layouts.partials._sidebar')
                {{-- sidebar --}}

                <!--app-content open-->
                <div class="main-content app-content mt-0">
                    <div class="side-app">

                        <!-- CONTAINER -->
                        <div class="main-container container-fluid" style="margin-top: 6rem;">
                            {{-- page title --}}
                            <div class="page-header">
                                <h1 class="page-title">@yield('page_title')</h1>
                                <div>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('admin.dashboard') }}">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page"
                                            href="{{ url()->current() }}">@yield('page_title')</li>
                                    </ol>
                                </div>
                            </div>
                            {{-- page title --}}

                            {{-- main content --}}
                            @yield('main_content')
                            {{-- main content --}}
                        </div>
                        <!-- CONTAINER END -->
                    </div>
                </div>
                <!--app-content close-->
            </div>
            <!-- FOOTER -->
            <footer class="footer">
                <div class="container">
                    <div class="row align-items-center flex-row-reverse">
                        <div class="col-md-12 col-sm-12 text-center">
                            All Rights Reserved by <a href="/">us</a>.
                        </div>
                    </div>
                </div>
            </footer>
            <!-- FOOTER END -->

        </div>

        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- JQUERY JS -->
        <script src="{{ asset('assets/admin-module') }}/js/jquery.min.js"></script>
        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('assets/admin-module') }}/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('assets/admin-module') }}/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- SIDEBAR JS -->
        <script src="{{ asset('assets/admin-module') }}/plugins/sidebar/sidebar.js"></script>

        @stack('script')

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('assets/admin-module') }}/plugins/select2/select2.full.min.js"></script>

        <!-- SIDE-MENU JS-->
        <script src="{{ asset('assets/admin-module') }}/plugins/sidemenu/sidemenu.js"></script>

        <!-- INTERNAL INDEX JS -->
        <script src="{{ asset('assets/admin-module') }}/js/index1.js"></script>
        <!-- Color Theme js -->
        <script src="{{ asset('assets/admin-module') }}/js/themeColors.js"></script>
        <!-- CUSTOM JS -->
        <script src="{{ asset('assets/admin-module') }}/js/custom.js"></script>

        <!-- SWEET-ALERT JS -->
        <script src="{{ asset('assets/admin-module') }}/plugins/sweet-alert/sweetalert.min.js"></script>
        <script src="{{ asset('assets/admin-module') }}/js/sweet-alert.js"></script>

        {{-- globally used --}}
        <script src="{{ asset('assets/admin-module') }}/custom-js/global.js"></script>
        <script src="{{ asset('assets/admin-module') }}/custom-js/admin.js"></script>

        <script src="{{ asset('assets/admin-module') }}/custom-js/toastr.min.js"></script>
        {{-- toastr --}}
        <script>
            "use strict";
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif

            @if (session()->has('success'))
                toastr.success('{{ session('success') }}');
            @endif

            @if (session()->has('info'))
                toastr.info('{{ session('info') }}');
            @endif

            @if (session()->has('warning'))
                toastr.warning('{{ session('warning') }}');
            @endif

            @if (session()->has('error'))
                toastr.error('{{ session('error') }}');
            @endif

            function alert_function(id) {
                "use strict";
                swal({
                    title: "Are you sure ?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#028088",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        jQuery('#' + id).submit();
                    }

                    return false;
                })
            }
        </script>
        
        @stack('page_js')
    </body>

</html>
