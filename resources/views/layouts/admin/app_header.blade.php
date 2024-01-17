<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0)"></a>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="/">
                <img src="/assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo" style="width: 135px;">
                <img src="/assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo" style="width: 135px;">
            </a>

            <!-- LOGO -->
            <div class="d-none">
                <div class="main-header-center ms-3 d-none d-lg-block">
                    <input type="text" class="form-control" id="typehead" placeholder="Search for results..." autocomplete="off">
                    <button class="btn px-0 pt-2"><i class="fe fe-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                @if (haveNotifications())
                    <span class=" pulse-danger d-lg-none"></span>
                {{-- @elseif () --}}
                @endif
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                </button>

                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2">
                            <div class="dropdown d-lg-none d-flex">
                                <a href="javascript:void(0)" class="nav-link icon" data-bs-toggle="dropdown">
                                    <i class="fe fe-search"></i>
                                </a>
                                <div class="dropdown-menu header-search dropdown-menu-start">
                                    <div class="input-group w-100 p-2">
                                        <input type="text" class="form-control" placeholder="Search....">
                                        <div class="input-group-text btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex country">
                                <a class="nav-link icon text-center" data-bs-target="#country-selector"
                                    data-bs-toggle="modal">
                                    <i class="fe fe-globe"></i>
                                    {{-- <span class="fs-16 ms-2 d-none d-xl-block">English</span> --}}
                                </a>
                            </div>
                            <!-- COUNTRY -->
                            <div class="d-flex country">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </div>
                            <!-- Theme-Layout -->

                            <!-- FULL-SCREEN -->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="fe fe-minimize fullscreen-button"></i>
                                </a>
                            </div>
                            <!-- END FULL-SCREEN -->

                            <!-- PROJECT CHORES -->
                            {{-- <div class=""> --}}
                            <div class="d-none">
                                <div class="dropdown  d-flex shopping-cart">
                                    <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                                        <i class="fe fe-play"></i>

                                        <span class="pulse-danger"></span>

                                        {{-- <span class="badge bg-secondary header-badge">4</span> --}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <a href="#" class="btn btn-sm btn-outline-success btn-block p-2">
                                            {{ trans('messages.ProjectChore.CreateProjectChore') }}
                                        </a>
                                        <div class="header-dropdown-list message-menu">



                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <div class="dropdown-footer">
                                            <a class="btn btn-outline-success w-sm btn-sm py-2" href="#"><i class="fe fe-share-2"></i> {{ trans('messages.Project.Projects') }}</a>
                                            <a class="btn btn-outline-success w-sm btn-sm py-2 float-end" href="#"><i class="fe fe-watch"></i> {{ trans('messages.ProjectChore.ProjectChores') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROJECT-CHORES -->

                            <!-- NOTIFICATIONS -->
                            {{-- <div class=""> --}}
                            <div class="d-none">
                                <div class="dropdown  d-flex notifications">
                                    <a class="nav-link icon" data-bs-toggle="dropdown"><i
                                            class="fe fe-bell"></i><span class=" pulse"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <div class="drop-heading border-bottom">
                                            <div class="d-flex">
                                                <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="notifications-menu">
                                            <a class="dropdown-item d-flex" href="notify-list.html">
                                                <div class="me-3 notifyimg  bg-primary brround box-shadow-primary">
                                                    <i class="fe fe-mail"></i>
                                                </div>
                                                <div class="mt-1 wd-80p">
                                                    <h5 class="notification-label mb-1">New Application received
                                                    </h5>
                                                    <span class="notification-subtext">3 days ago</span>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="notify-list.html">
                                                <div class="me-3 notifyimg  bg-secondary brround box-shadow-secondary">
                                                    <i class="fe fe-check-circle"></i>
                                                </div>
                                                <div class="mt-1 wd-80p">
                                                    <h5 class="notification-label mb-1">Project has been
                                                        approved</h5>
                                                    <span class="notification-subtext">2 hours ago</span>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="notify-list.html">
                                                <div class="me-3 notifyimg  bg-success brround box-shadow-success">
                                                    <i class="fe fe-shopping-cart"></i>
                                                </div>
                                                <div class="mt-1 wd-80p">
                                                    <h5 class="notification-label mb-1">Your Product Delivered
                                                    </h5>
                                                    <span class="notification-subtext">30 min ago</span>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="notify-list.html">
                                                <div class="me-3 notifyimg bg-pink brround box-shadow-pink">
                                                    <i class="fe fe-user-plus"></i>
                                                </div>
                                                <div class="mt-1 wd-80p">
                                                    <h5 class="notification-label mb-1">Friend Requests</h5>
                                                    <span class="notification-subtext">1 day ago</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <a href="notify-list.html"
                                            class="dropdown-item text-center p-3 text-muted">View all
                                            Notification</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END NOTIFICATIONS -->

                            <!-- MESSAGE-BOX -->
                            {{-- <div class=""> --}}
                            <div class="d-none">
                                <div class="dropdown d-flex message">
                                    <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                                        <i class="fe fe-message-square"></i><span class="pulse-danger"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <div class="drop-heading border-bottom p-3">
                                            <div class="d-flex">
                                                <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">
                                                    Tareas pendientes: 25
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="message-menu message-menu-scroll">
                                            <a class="dropdown-item d-flex" href="chat.html">
                                                <span
                                                    class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                    data-bs-image-src="/assets/images/users/15.jpg"></span>
                                                <div class="wd-90p">
                                                    <div class="d-flex">
                                                        <h5 class="mb-1">Abagael Luth</h5>
                                                        <small class="text-muted ms-auto text-end">
                                                            10:35 am
                                                        </small>
                                                    </div>
                                                    <span>New Meetup Started......</span>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="chat.html">
                                                <span
                                                    class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                    data-bs-image-src="/assets/images/users/12.jpg"></span>
                                                <div class="wd-90p">
                                                    <div class="d-flex">
                                                        <h5 class="mb-1">Brizid Dawson</h5>
                                                        <small class="text-muted ms-auto text-end">
                                                            2:17 pm
                                                        </small>
                                                    </div>
                                                    <span>Brizid is in the Warehouse...</span>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="chat.html">
                                                <span
                                                    class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                    data-bs-image-src="/assets/images/users/4.jpg"></span>
                                                <div class="wd-90p">
                                                    <div class="d-flex">
                                                        <h5 class="mb-1">Shannon Shaw</h5>
                                                        <small class="text-muted ms-auto text-end">
                                                            7:55 pm
                                                        </small>
                                                    </div>
                                                    <span>New Product Realease......</span>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex" href="chat.html">
                                                <span
                                                    class="avatar avatar-md brround me-3 align-self-center cover-image"
                                                    data-bs-image-src="/assets/images/users/3.jpg"></span>
                                                <div class="wd-90p">
                                                    <div class="d-flex">
                                                        <h5 class="mb-1">Cherry Blossom</h5>
                                                        <small class="text-muted ms-auto text-end">
                                                            7:55 pm
                                                        </small>
                                                    </div>
                                                    <span>You have appointment on......</span>
                                                </div>
                                            </a>

                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <a href="javascript:void(0)" class="dropdown-item text-center p-3 text-muted">See all
                                            Messages</a>
                                    </div>
                                </div>
                            </div>
                            <!--END MESSAGE-BOX -->

                            <!-- SIDE-MENU -->

                            <div class="">
                                @if (myNotifications())
                                    <div class="dropdown d-flex header-settings">
                                @else
                                    <div class="d-none">
                                @endif
                                    <a href="javascript:void(0);" class="nav-link icon"
                                        data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                        <i class="fe fe-align-right"></i>
                                        @if (haveNotifications())
                                            <span class=" pulse-danger"></span>
                                        {{-- @elseif () --}}
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <!-- END SIDE-MENU -->

                            <div class="dropdown d-flex profile-1">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
                                    @if (auth()->user()->userProfile)
                                        @if (auth()->user()->userProfile->photo)
                                            <span class="avatar avatar-md brround cover-image"
                                                data-bs-image-src="{{ Storage::url(auth()->user()->userProfile->photo) }}"
                                                style="background: url(&quot;{{ Storage::url(auth()->user()->userProfile->photo) }}&quot;) center center;">
                                            </span>
                                        @else
                                            <span class="avatar avatar-md brround bg-default">
                                                {{ substr(auth()->user()->userProfile->name,0,1).substr(auth()->user()->userProfile->lastname,0,1) }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="avatar avatar-md brround bg-default">
                                            {{ substr(auth()->user()->name,0,1) }}
                                        </span>
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0 fs-14 fw-semibold">{{ auth()->user()->name }}</h5>
                                            <small class="text-muted">{{ auth()->user()->userProfile ? auth()->user()->userProfile->full_name:auth()->user()->name }}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>

                                    <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                                        <i class="dropdown-icon fe fe-user"></i> {{ trans('messages.Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon fe fe-user"></i> {{ trans('messages.MySpace.MyDatas') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon fe fe-alert-circle"></i>{{ trans('messages.Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @if ($pendingProjectChores)
    @foreach ( $pendingProjectChores as $pendingProjectChore )
        <div class="modal fade" id="pendingChoreModal{{ $pendingProjectChore->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="z-index: 99;">
                    <div class="modal-header">
                        <h4 class="modal-title fw-bold"><i class="fe fe-clock"></i>&nbsp;{{ trans('messages.TimeRecords') }}</h4>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    {!! Form::open(array(
                        'route'=>['admin.projectTimes.startTime',$pendingProjectChore->id],
                        'method'=>'POST',
                        'name'=>'form_modal_pending_chore_'.$pendingProjectChore->id,
                        'id'=>'form_modal_pending_chore_'.$pendingProjectChore->id,
                    )) !!}
                    @csrf
                        <input type="hidden" name="project_chore_id" value="{{ $pendingProjectChore->id }}">
                        <input type="hidden" name="customer_id" value="{{ $pendingProjectChore->project->customer->id }}">
                        <div class="modal-body">
                            <div class="example mb-2">
                                <h6>
                                    <p>
                                        <i class="fa-regular fa-hand-point-right"></i>&nbsp;
                                        {{ trans('messages.Project.Project') }}: <span class="fw-bold">{{ $pendingProjectChore->project->name }}</span>
                                    </p>
                                    <p>
                                        <i class="fa-regular fa-hand-point-right"></i>&nbsp;
                                        {{ trans('messages.ProjectChore.ProjectChore') }}: <span class="fw-bold">{{ $pendingProjectChore->name }}</span>
                                    </p>
                                    <p>
                                        <i class="fa-regular fa-hand-point-right"></i>&nbsp;
                                        {{ trans('messages.ProjectRate.ProjectRate') }}: <span class="fw-bold">{{ $pendingProjectChore->projectRate->name }}</span>
                                    </p>
                                </h6>
                            </div>
                                <div class="row p-0 m-0">
                                    <div class="col-6 px-3 px-xl-1">
                                        <div class="form-group">
                                            <label class="custom-control custom-radio-md mb-0 mt-1">
                                                {!! Form::radio('billable',1,$pendingProjectChore->billable==1?true:false,[
                                                    'class'=>'custom-control-input',
                                                ]) !!}
                                                <span class="custom-control-label">{{ trans('messages.Billable') }}</span>
                                            </label>
                                            <label class="custom-control custom-radio-md mb-0 mt-1">
                                                {!! Form::radio('billable',0,$pendingProjectChore->billable==0?true:false,[
                                                    'class'=>'custom-control-input',
                                                ]) !!}
                                                <span class="custom-control-label">No&nbsp;{{ trans('messages.Billable') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label m-0"><small>{{ trans('messages.Rate') }}</small></label>
                                            {!! Form::select('project_rate_id', $projectRates,$pendingProjectChore->project_rate_id,[
                                                'class'=>'form-control select2 form-select',
                                                'data-bs-placeholder'=>'Select '.trans('messages.Rate'),
                                                'style'=>'width: 100%;',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-0 m-0">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="col-form-label"><small>{{ trans('messages.Description') }}</small></label>
                                            {{ Form::textarea('description', $pendingProjectChore->name, array(
                                                'class' =>'form-control',
                                                'rows' =>4,
                                                'required' => '',
                                            ))}}
                                        </div>
                                    </div>
                                </div>
                            <div class="panel-group1" id="accordion{{ $pendingProjectChore->id }}">
                                <div class="panel panel-default mb-4">
                                    <div class="panel-heading1">
                                        <h6 class="panel-title1 p-0 m-0">
                                            <a class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion{{ $pendingProjectChore->id }}" href="#collapseManualTime{{ $pendingProjectChore->id }}" aria-expanded="false">{{ trans('messages.ManualTime') }}</a>
                                        </h6>
                                    </div>
                                    <div id="collapseManualTime{{ $pendingProjectChore->id }}" class="panel-collapse collapse" role="tabpanel" aria-expanded="false">
                                        <div class="panel-body p-1">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group m-0">
                                                        {{ Form::number('hours', null, array(
                                                            'class' =>'form-control',
                                                            'step' => 1,
                                                            'min'=>0,
                                                            'placeholder'=>trans('messages.Time.Hours'),
                                                            'style'=>'text-align:right;',
                                                        ))}}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group m-0">
                                                        {{ Form::number('minutes', null, array(
                                                            'class' =>'form-control',
                                                            'step' => 1,
                                                            'min'=>0,
                                                            'placeholder'=>trans('messages.Time.Minutes'),
                                                            'style'=>'text-align:right;',
                                                        ))}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn ripple btn-outline-success" type="submit">{{ trans('messages.Save') }}</button>
                            <button class="btn ripple btn-outline-danger" data-bs-dismiss="modal" type="button">{{ trans('messages.Cancel') }}</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
@endif
--}}


@section('header-scripts')

@endsection
