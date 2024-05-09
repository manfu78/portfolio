<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Porfolio Germán Raúl García">
        <meta name="author" content="German R. Garcia full-stack developer">
        <meta name="keywords" content="windvalley,CRM,gestion,multiempresa,multitenant,admin,admin dashboard,admin panel,bootstrap,clean,dashboard,flat,jquery,modern,responsive,responsive admin,ui,ui kit,porfolio,cv,curriculum">

        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="57x57" href="/assets/images/brand/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/assets/images/brand/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/images/brand/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/brand/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/images/brand/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/assets/images/brand/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/assets/images/brand/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/assets/images/brand/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/brand/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/assets/images/brand/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/brand/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/assets/images/brand/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/brand/favicon-16x16.png">
        <link rel="manifest" href="/assets/images/brand/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/assets/images/brand/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- TITLE -->
        <title>{{ config('app.name', 'Windvalley') }} | @yield('sectiontitle')</title>

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="/assets/css/style.css" rel="stylesheet" />
        <link href="/assets/css/dark-style.css" rel="stylesheet" />
        <link href="/assets/css/transparent-style.css" rel="stylesheet">
        <link href="/assets/css/skin-modes.css" rel="stylesheet" />

        <!--- FONT-ICONS CSS -->
        <link href="/assets/css/icons.css" rel="stylesheet" />

        <!-- COLOR SKIN CSS -->
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="/assets/colors/color1.css" />

        <!-- Font Awesome -->
        <link href="/assets/plugins/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet">
        <link href="/assets/plugins/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet">
        <link href="/assets/plugins/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet">

        {{-- @vite(['resources/sass/app.scss']) --}}
        <style>
            .login-my-img {
                position: relative;
                background-image: url(../landing-assets/img/bg.png);
            }
        </style>
        @yield('page_css')
        @yield('scripts_header')
        @yield('styles')
    </head>
    <body class="app sidebar-mini ltr login-my-img">
        <!-- BACKGROUND-IMAGE -->
        <div class="">

            @include('layouts.admin.global_loader')

            <div class="page">
                <div class="">
                    <!-- CONTAINER OPEN -->
                    {{-- <div class="col col-login mx-auto mt-7">
                        <div class="text-center">
                            <a href="/"><img src="/assets/images/brand/logo-white.png" class="header-brand-img" alt="" style="height: 50px;"></a>
                        </div>
                    </div> --}}
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- JQUERY JS -->
        <script src="/assets/js/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- SHOW PASSWORD JS -->
        <script src="/assets/js/show-password.min.js"></script>

        <!-- GENERATE OTP JS -->
        <script src="/assets/js/generate-otp.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

        <!-- Color Theme js -->
        <script src="/assets/js/themeColors.js"></script>

        <!-- CUSTOM JS -->
        <script src="/assets/js/custom.js"></script>

        @yield('scripts')
    </body>
</html>
