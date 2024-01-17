<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body p-1">
                <ul class="nav nav-pills nav-pills-circle" role="tablist">
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.userConfigurations.favorites')?'#':route('admin.userConfigurations.favorites') }}" class="nav-link border py-1 px-2 m-2 {{ request()->routeIs('admin.userConfigurations.favorites')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-star"></i>&nbsp;{{ trans('messages.Edit') }}&nbsp;{{ trans('messages.Favorites') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.userConfigurations.homepage')?'#':route('admin.userConfigurations.homepage') }}" class="nav-link border py-1 px-2 m-2 {{ request()->routeIs('admin.userConfigurations.homepage')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-house"></i>&nbsp;{{ trans('messages.Edit') }}&nbsp;{{ trans('messages.Home.Homepage') }}</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
