<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body p-1">
                <ul class="nav nav-pills nav-pills-circle" role="tablist">
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.businesses.edit')?'#':route('admin.businesses.edit',$business) }}" class="nav-link border py-1 px-2 m-2 {{ request()->routeIs('admin.businesses.edit')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-user-pen"></i>&nbsp;{{ trans('messages.Business.Business') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.businesses.editDocuments')?'#':route('admin.businesses.editDocuments',$business) }}" class="nav-link border py-1 px-5 m-2 {{ request()->routeIs('admin.businesses.editDocuments')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-folder-open"></i>&nbsp;{{ trans('messages.Documents') }}</span>
                        </a>
                    </li>
                    {{-- @if ($business->projects&&$business->projects->count()>0)
                        <li class="nav-item">
                            <a href="#business_projects" class="nav-link border py-1 px-5 m-2">
                                <span class="nav-link-icon d-block"><i class="fe fe-share-2"></i>&nbsp;{{ trans('messages.Project.Projects') }} </span>
                            </a>
                        </li>
                    @endif --}}
                </ul>
            </div>
        </div>
    </div>
</div>
