@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Home.SetHomepage') }} @endsection
@section('pagetitle') {{ trans('messages.Home.Homepage') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>{{ trans('messages.Dashboard.Dashboard') }}</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Home.Homepage') }}</small></li>
                </ol>
            </div>
        </div>

        @include('admin.UserConfigurations.Partials.menu')

        {{-- HOME PAGE --}}
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h1 class="page-title"><i class="fa-solid fa-home"></i>&nbsp;{{ trans('messages.Home.SetHomepage') }}</h1>
                    </div>
                    <div class="card-body">
                        @if (userHome())
                            <div class="">
                                <ul class="list-group">
                                    <li class="list-group-item justify-content-between">
                                        <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{trans('messages.'.userHome()->name) }}</span>
                                        <a href="{{ route('admin.userConfigurations.homeUnset') }}">
                                            <button type="button" type="submit" class="badgetext badge bg-danger rounded-pill border-0">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        @else
                        <div class="">
                                <ul class="list-group">
                                    <li class="list-group-item justify-content-between">
                                        <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ trans('messages.Dashboard.Dashboard') }}</span>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- MENU --}}
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="row row-sm">
                    <div class="col">
                            <div class="card">
                                <div class="card-header bg-info-transparent p-2">
                                    <h1 class="page-title"><i class="fa-solid fa-grip-vertical"></i>&nbsp;{{ trans('messages.Add') }}&nbsp;{{ trans('messages.Home.Homepage') }}</h1>
                                </div>
                                <div class="card-body">
                                    <div class="row row-sm">
                                        <div class="col">
                                            @foreach ($sidebarMenuFathers as $sidebarMenuFather)
                                                @canany( $sidebarMenuFather->permissionsForMenu() )
                                                    <div class="accordion" id="sidebarMenuFather{{ $sidebarMenuFather->id }}">
                                                        <div class="accordion-item mb-2">
                                                            <h2 class="accordion-header bg-default" id="heading{{ $sidebarMenuFather->id }}">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $sidebarMenuFather->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                                                    <span class="fw-bold">
                                                                        <i class="{{ $sidebarMenuFather->icon }}"></i>&nbsp;
                                                                        &nbsp;
                                                                        {{ $sidebarMenuFather->name }}
                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse{{ $sidebarMenuFather->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $sidebarMenuFather->id }}" data-bs-parent="#sidebarMenuFather{{ $sidebarMenuFather->id }}">
                                                                <div class="accordion-body">
                                                                    <div class="">
                                                                        <ul class="list-group">
                                                                            @foreach ($sidebarMenuFather->sidebarMenus as $sidebarMenu)
                                                                                @can($sidebarMenu->permission)
                                                                                    <li class="list-group-item justify-content-between">
                                                                                        <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $sidebarMenu->name }}</span>

                                                                                        <a href="{{ route('admin.userConfigurations.homeSet',$sidebarMenu) }}">
                                                                                            <button type="button" class="badgetext badge bg-default rounded-pill border-0 mx-2">
                                                                                                <i class="fa-solid fa-house"></i>
                                                                                            </button>
                                                                                        </a>
                                                                                    </li>
                                                                                @endcan
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                    @if ($sidebarMenuFather->sidebarMenuSubFathers->count()>0)
                                                                        @foreach ($sidebarMenuFather->sidebarMenuSubFathers as $sidebarMenuSubFather)
                                                                            @canany( $sidebarMenuSubFather->permissionsForMenu() )
                                                                                <div class="accordion mt-3" id="sidebarMenuSubFather{{ $sidebarMenuSubFather->id }}">
                                                                                    <div class="accordion-item mb-2">
                                                                                        <h2 class="accordion-header" id="headingMenuSubFather{{ $sidebarMenuFather->id }}">
                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMenuSubFather{{ $sidebarMenuSubFather->id }}" aria-expanded="false" aria-controls="collapseMenuSubFather{{ $sidebarMenuSubFather->id }}">
                                                                                                <span class="fw-bold">
                                                                                                    <i class="fa-solid fa-angles-right"></i>&nbsp;
                                                                                                    &nbsp;
                                                                                                    {{ $sidebarMenuSubFather->name }}
                                                                                                </span>
                                                                                            </button>
                                                                                        </h2>
                                                                                        <div id="collapseMenuSubFather{{ $sidebarMenuSubFather->id }}" class="accordion-collapse collapse" aria-labelledby="headingMenuSubFather{{ $sidebarMenuSubFather->id }}" data-bs-parent="#sidebarMenuSubFather{{ $sidebarMenuFather->id }}">
                                                                                            <div class="accordion-body">
                                                                                                <div class="">
                                                                                                    <ul class="list-group">
                                                                                                        @foreach ($sidebarMenuSubFather->sidebarMenus as $sidebarSubMenu)
                                                                                                            @can($sidebarSubMenu->permission)
                                                                                                                <li class="list-group-item justify-content-between">
                                                                                                                    <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $sidebarSubMenu->name }}</span>

                                                                                                                    <a href="{{ route('admin.userConfigurations.homeSet',$sidebarMenu) }}">
                                                                                                                        <button type="button" class="badgetext badge bg-default rounded-pill border-0 mx-2">
                                                                                                                            <i class="fa-solid fa-house"></i>
                                                                                                                        </button>
                                                                                                                    </a>
                                                                                                                </li>
                                                                                                            @endcan
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endcan
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endcan
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts_js')

@endsection

@section('scripts')
@endsection
