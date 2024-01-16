<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.admin.app_head')

        {{-- @vite(['resources/sass/app.scss']) --}}

        @yield('page_css')
        @yield('scripts_header')
        @yield('styles')
    </head>
    <body class="app sidebar-mini ltr light-mode">

        @include('layouts.admin.global_loader')

        {{-- content --}}
        @include('layouts.admin.app_page')

        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top" class="d-print-none"><i class="fa fa-angle-up"></i></a>

        @include('layouts.admin.app_basic_scripts_js')
        @yield('scripts_js')

        @include('layouts.admin.app_basic_scripts')
        @yield('scripts')
        {{-- @yield('header-scripts') --}}

    </body>
</html>
