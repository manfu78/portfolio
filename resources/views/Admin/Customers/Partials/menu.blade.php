<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body p-1">
                <ul class="nav nav-pills nav-pills-circle" role="tablist">
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.customers.edit')?'#':route('admin.customers.edit',$customer) }}" class="nav-link border py-1 px-2 m-2 {{ request()->routeIs('admin.customers.edit')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-user-pen"></i>&nbsp;{{ trans('messages.Customer.Customer') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.customers.editDocuments')?'#':route('admin.customers.editDocuments',$customer) }}" class="nav-link border py-1 px-5 m-2 {{ request()->routeIs('admin.customers.editDocuments')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-folder-open"></i>&nbsp;{{ trans('messages.Documents') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
