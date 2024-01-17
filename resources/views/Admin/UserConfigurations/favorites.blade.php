@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Favorite.EditFavorites') }} @endsection
@section('pagetitle') {{ trans('messages.Favorite.Favorites') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>{{ trans('messages.Dashboard.Dashboard') }}</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Favorites') }}</small></li>
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

        {{-- FAVORITES --}}
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h1 class="page-title"><i class="fa-solid fa-star"></i>&nbsp;{{ trans('messages.Menu') }}&nbsp;{{ trans('messages.Favorites') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <ul class="list-group">
                                @if ($userFavorites)
                                    @foreach ($userFavorites as $userFavorite)
                                        @can($userFavorite->sidebarMenu->permission)
                                            <form name="formDeleteUserFavorite{{ $userFavorite->id }}" id="formDeleteUserFavorite{{ $userFavorite->id }}" method="POST" action="{{ route('admin.userConfigurations.favoriteDestroy',$userFavorite->id ) }}">
                                                @csrf @method('DELETE')
                                                <li class="list-group-item justify-content-between">
                                                    <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $userFavorite->sidebarMenu->name }}</span>
                                                    <button type="submit" class="badgetext badge bg-danger rounded-pill border-0">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>
                                                </li>
                                            </form>
                                        @endcan
                                    @endforeach
                                @endif
                            </ul>
                        </div>
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
                                    <h1 class="page-title"><i class="fa-solid fa-grip-vertical"></i>&nbsp;{{ trans('messages.Add') }}&nbsp;{{ trans('messages.Favorites') }}</h1>
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
                                                                                    @if ($arrayUserFavorites&&in_array($sidebarMenu->id,$arrayUserFavorites) )
                                                                                        <form name="formDeleteFavorite{{ $sidebarMenu->id }}" id="formDeleteFavorite{{ $sidebarMenu->id }}" method="POST" action="{{ route('admin.userConfigurations.favoriteDestroy',$sidebarMenu->id ) }}">
                                                                                        @csrf @method('DELETE')
                                                                                            <li class="list-group-item justify-content-between">
                                                                                                <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $sidebarMenu->name }}</span>
                                                                                                <button type="submit" class="badgetext badge bg-danger rounded-pill border-0">
                                                                                                    <i class="fa-solid fa-minus"></i>
                                                                                                </button>
                                                                                            </li>
                                                                                        </form>
                                                                                    @else
                                                                                        <li class="list-group-item justify-content-between">
                                                                                            <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $sidebarMenu->name }}</span>
                                                                                            <a href="{{ route('admin.userConfigurations.favoriteAdd',$sidebarMenu) }}">
                                                                                                <button type="button" class="badgetext badge bg-success rounded-pill border-0">
                                                                                                    <i class="fa-solid fa-plus"></i>
                                                                                                </button>
                                                                                            </a>
                                                                                        </li>
                                                                                    @endif
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
                                                                                                                @if ($arrayUserFavorites&&in_array($sidebarSubMenu->id,$arrayUserFavorites) )
                                                                                                                    <form name="formDeleteFavorite{{ $sidebarSubMenu->id }}" id="formDeleteFavorite{{ $sidebarSubMenu->id }}" method="POST" action="{{ route('admin.userConfigurations.favoriteDestroy',$sidebarSubMenu->id ) }}">
                                                                                                                    @csrf @method('DELETE')
                                                                                                                        <li class="list-group-item justify-content-between">
                                                                                                                            <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $sidebarSubMenu->name }}</span>
                                                                                                                            <button type="submit" class="badgetext badge bg-danger rounded-pill border-0">
                                                                                                                                <i class="fa-solid fa-minus"></i>
                                                                                                                            </button>
                                                                                                                        </li>
                                                                                                                    </form>
                                                                                                                @else
                                                                                                                    <li class="list-group-item justify-content-between">
                                                                                                                        <span><i class="fa-regular fa-angle-right"></i>&nbsp;{{ $sidebarSubMenu->name }}</span>
                                                                                                                        <a href="{{ route('admin.userConfigurations.favoriteAdd',$sidebarSubMenu) }}">
                                                                                                                            <button type="button" class="badgetext badge bg-success rounded-pill border-0">
                                                                                                                                    <i class="fa-solid fa-plus"></i>
                                                                                                                            </button>
                                                                                                                        </a>
                                                                                                                    </li>
                                                                                                                @endif
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
