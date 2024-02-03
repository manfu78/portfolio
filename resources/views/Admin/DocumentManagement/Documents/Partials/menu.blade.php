<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body p-1">
                <ul class="nav nav-pills nav-pills-circle" role="tablist">
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.documents.index')?'#':route('admin.documents.index') }}" class="nav-link border py-1 px-2 m-2 {{ request()->routeIs('admin.documents.index')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-file"></i>&nbsp;{{ trans('messages.Document.Documents') }}</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{ request()->routeIs('admin.documents.massiveUpload')?'#':route('admin.documents.massiveUpload') }}" class="nav-link border py-1 px-5 m-2 {{ request()->routeIs('admin.documents.massiveUpload')?'active':'' }}">
                            <span class="nav-link-icon d-block"><i class="fa-solid fa-file-import"></i>&nbsp;{{ trans('messages.MassiveUpload') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
