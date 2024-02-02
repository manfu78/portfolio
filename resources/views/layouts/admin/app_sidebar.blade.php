<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="/">
                <img src="/assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo" style="width: 135px;">
                <img src="/assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="/assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                <img src="/assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo" style="width: 135px;">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class="side-menu__label">
                            @if (userHome())
                                {{ trans('messages.'.userHome()->name) }}
                            @else
                                Dashboard
                            @endif
                        </span>
                    </a>
                </li>

                @if (sidebarMenuFavorites())
                    <li class="slide {{(
                        request()->routeIs('admin.profile.*')
                        ) ? 'is-expanded':''}}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="side-menu__icon fa-solid fa-star"></i>
                            <span class="side-menu__label">{{ trans('messages.Favorites') }}</span>
                            <i class="angle fe fe-chevron-right"></i>
                        </a>
                        <ul class="slide-menu">
                            @foreach (sidebarMenuFavorites() as $sidebarMenuFavorite)
                                @can($sidebarMenuFavorite->permission)
                                    <li>
                                        <a href="{{ route($sidebarMenuFavorite->route) }}" class="slide-item {{request()->routeIs($sidebarMenuFavorite->route) ? 'active fw-bold':''}}">
                                            {{ trans('messages.'.$sidebarMenuFavorite->name) }}
                                        </a>
                                    </li>
                                @endcan
                            @endforeach
                        </ul>
                    </li>
                @endif

                <li class="slide {{(
                    request()->routeIs('admin.profile.*')||
                    request()->routeIs('admin.myNotifications')||
                    request()->routeIs('admin.userConfigurations.*')||
                    request()->routeIs('admin.mySpaces.*')
                    ) ? 'is-expanded':''}}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-user"></i>
                        <span class="side-menu__label">{{ trans('messages.MySpaces') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        {{-- <li class="side-menu-label1"><a href="javascript:void(0)">Pages</a></li> --}}

                        <li>
                            <a href="{{ route('admin.profile.show') }}" class="slide-item {{request()->routeIs('admin.profile.*') ? 'active fw-bold':''}}">
                                {{ trans('messages.Profile') }}
                            </a>
                        </li>
                        @if (myNotifications())
                            <li>
                                <a href="{{ route('admin.myNotifications') }}" class="slide-item {{request()->routeIs('admin.myNotifications') ? 'active fw-bold':''}}">
                                    {{ trans('messages.Notification.Notifications') }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('admin.userConfigurations.favorites') }}" class="slide-item {{request()->routeIs('admin.userConfigurations.favorites') ? 'active fw-bold':''}}">
                                {{ trans('messages.Configurations') }}
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.calendar.index') }}" class="slide-item {{request()->routeIs('admin.calendar.index') ? 'active fw-bold':''}}">
                                {{ trans('messages.Calendar.Calendar') }}
                            </a>
                        </li> --}}

                    </ul>
                </li>

                <li class="sub-category">
                    <h3>{{ trans('messages.Menu') }}</h3>
                </li>

                @foreach (sidebarMenuFathers() as $sidebarMenuFather )
                    @canany( $sidebarMenuFather->permissionsForMenu() )
                        <li class="slide {{ (request()->routeIs(
                            $sidebarMenuFather->routesForExpandedMenu()
                            ))? 'is-expanded':''}}">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                <i class="{{ $sidebarMenuFather->icon }}"></i>
                                <span class="side-menu__label">{{ trans('messages.'.$sidebarMenuFather->name) }}</span>
                                <i class="angle fe fe-chevron-right"></i>
                            </a>

                            <ul class="slide-menu">
                                @foreach ($sidebarMenuFather->sidebarMenuItems as $sidebarMenuItem)
                                    @can($sidebarMenuItem->permission)
                                        <li>
                                            <a href="{{ route($sidebarMenuItem->route) }}" class="slide-item {{request()->routeIs(routeForActiveMenu($sidebarMenuItem->route)) ? 'active fw-bold':''}}">
                                                {{ trans('messages.'.$sidebarMenuItem->name) }}
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                                @if ($sidebarMenuFather->sidebarMenuSubFathers->count()>0)
                                    @foreach ($sidebarMenuFather->sidebarMenuSubFathers as $sidebarMenuSubFather)
                                        @canany( $sidebarMenuSubFather->permissionsForMenu() )
                                            <li class="sub-slide {{ (request()->routeIs(
                                                    $sidebarMenuSubFather->routesForExpandedMenu()
                                                ))? 'is-expanded':''}}">
                                                <a class="sub-side-menu__item fw-bold" data-bs-toggle="sub-slide" href="javascript:void(0)">
                                                    <span class="sub-side-menu__label">{{ $sidebarMenuSubFather->name }}</span>
                                                    <i class="sub-angle fe fe-chevron-right"></i>
                                                </a>
                                                <ul class="sub-slide-menu">
                                                    @foreach ($sidebarMenuSubFather->sidebarMenuItems as $subSidebarMenu)
                                                        @can($subSidebarMenu->permission)
                                                            <li>
                                                                <a href="{{ route($subSidebarMenu->route) }}" class="sub-slide-item {{ request()->routeIs(routeForActiveMenu($subSidebarMenu->route)) ? 'active fw-bold':''}}">
                                                                    {{ trans('messages.'.$subSidebarMenu->name) }}
                                                                </a>
                                                            </li>
                                                        @endcan
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endcan
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endcan
                @endforeach

                <li class="sub-category">
                    <h3>Info</h3>
                </li>
                <li class="slide">

                    {{-- @can('appreviews.index')
                        <a class="side-menu__item" href="#">
                            <i class="side-menu__icon fe fe-users"></i>
                            <span class="side-menu__label">Sessions</span>
                        </a>
                    @endcan --}}
                    @can('log-viewer::dashboard')
                        <a class="side-menu__item" href="/clear-cache">
                            <i class="side-menu__icon fe fe-refresh-ccw"></i>
                            <span class="side-menu__label">Clear Caché</span>
                        </a>

                        <a class="side-menu__item" href="{{ route('log-viewer::dashboard') }}" target="_blank">
                            <i class="side-menu__icon fe fe-eye"></i>
                            <span class="side-menu__label">{{ trans('messages.Log.ViewLogs') }}</span>
                        </a>
                    @endcan
                    <hr>
                    <a class="side-menu__item" href="javascript:void(0)">
                        <small class="side-menu__label mb-3">
                            {{ trans('messages.WeekDays.'.date("l")) }}
                            {{ date("d-m-Y") }}
                        </small>
                    </a>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
