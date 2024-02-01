@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Worker.CreateWorker') }} @endsection
@section('pagetitle') {{ trans('messages.Worker.Worker') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.workers.index') }}">{{ trans('messages.Worker.Workers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Worker.CreateWorker') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.workers.store') }}" method="post" name="form_workers_store" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                        @include('Admin.Workers.Partials.form_worker_photo')
                        @include('Admin.Workers.Partials.form_worker_user_asign')
                        @include('Admin.Workers.Partials.form_worker_information')
                        @include('Admin.Workers.Partials.form_worker_address')
                        @include('Admin.Workers.Partials.form_worker_others')

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.categories.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSelectUser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h4 class="modal-title fw-bold"><i class="fe fe-users"></i>&nbsp;{{ trans('messages.User.Users') }}</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    @if ($users->first())
                        <table id="users_table" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="border-bottom-0"><small>id</small></th>
                                <th class="border-bottom-0"><small>{{ trans('messages.Username') }}</small></th>
                                <th class="border-bottom-0"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td style="width: 30px;">{{ $user->id }}</td>
                                    <td style="text-align: left">
                                        <b>
                                            {!! $user->worker ? ('<span class="text-success"><i class="fa-solid fa-circle"></i></span>'):'&nbsp;' !!}&nbsp;
                                            {{ $user->name }}
                                        </b>
                                    </td>
                                    <td class="text-end" style="width: 30px;">
                                        <a href="#" class="btn btn-sm btn-green" onclick="setUser({{ $user->id }},'{{ $user->name }}')"><i class="fe fe-plus-circle fw-bold"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-12 text-center">
                            <span>{{ trans('messages.Worker.NoWorkers') }}</span>
                            @can('users.create')
                                <h1><a href="{{ route('admin.users.create') }}"><i class="fa-solid fa-circle-plus text-success"></i></a></h1>
                            @endcan
                        </div>

                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" data-bs-dismiss="modal">{{ trans('messages.Cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
<script>
    function setUser(id,name){
        inputUserId = document.getElementById('user_id');
        inputUserName = document.getElementById('user_name');
        inputUserId.value = id;
        inputUserName.value = name;
        $('#modalSelectUser').modal('hide')
    }
</script>
@endsection
