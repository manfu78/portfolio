<div class="page">

    <div class="page-main">

        <!-- app-Header -->
        @include('layouts.admin.app_header')

        <!--APP-SIDEBAR-->
        @include('layouts.admin.app_sidebar')

        <!--app-content open-->
        @include('layouts.admin.app_content')

    </div>

    <!-- Sidebar-right -->
    @include('layouts.admin.app_sidebar_right')

    <!-- Country-selector modal-->
    @include('layouts.admin.modal_country_selector')

    <!-- FOOTER -->
    @include('layouts.admin.app_footer')

</div>
