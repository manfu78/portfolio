@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.User.Users') }} @endsection
@section('pagetitle') {{ trans('messages.User.Users') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.User.Users') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                @can('users.create')
                    <div class="card">
                        <div class="card-body py-2">
                            <div class="row">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.users.create') }}">
                                            <span class="nav-link-icon d-block"><i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.User.NewUser') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h1 class="page-title"><i class="fa-solid fa-grip-vertical"></i>&nbsp;{{ trans('messages.User.Users') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0"><small>id</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.User.User') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Worker.Worker') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Role.Roles') }}</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="py-1" style="width: 10px;">{{$user->id}}</td>
                                            <td class="py-1"><span class="fw-bold">{{$user->name}}</span></td>
                                            <td class="py-1">
                                                @if ($user->worker)
                                                    @if ($user->worker->photo)
                                                        <span class="avatar avatar-sm brround cover-image" data-bs-image-src="{{ Storage::url($user->worker->photo) }}"></span>
                                                    @else
                                                        <span class="avatar avatar-sm brround cover-image" data-bs-image-src="/dist/img/profileimg.png"></span>
                                                    @endif
                                                    &nbsp;<a href="{{ route('admin.workers.edit',$user->worker) }}">{{ $user->worker->full_name }}</a>
                                                @else
                                                    ...
                                                @endif
                                            </td>
                                            <td class="py-1">
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $rolName)
                                                        <span class="badge bg-gray rounded-pill">{{ $rolName }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('users.edit')
                                                    <a href="{{ route('admin.users.edit', $user) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('users.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $user->username }}"
                                                        data-route="{{ route('admin.users.destroy',$user->id) }}">
                                                        <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                            <i class="fe fe-trash"></i>
                                                        </div>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    @can('users.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#users_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [4] },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 4 },
                ],
                "order": [[0, 'asc']],
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ ",
                    "zeroRecords": "No se han encontrado registros",
                    "info": "P&aacute;gina _PAGE_ de _PAGES_",
                    "infoEmpty": "Mostrando 0 to 0 of 0 registros",
                    "emptyTable": "No hay datos en la tabla",
                    "infoEmpty": "Sin registros",
                    "loadingRecords": "Cargando...",
                    "infoFiltered": "(filtrados de _MAX_ registros)",
                    "processing": "Procesando...",
                    "search": "Busc: ",
                    "thousands": ".",
                    "decimal": ",",
                    "paginate": {
                        "first": "Primero",
                        "last": "&Uacute;ltimo",
                        "next": ">",
                        "previous": "<"
                    }
                },
                "buttons": {
                    "dom": {
                        "button": {
                            "className": "btn btn-outline-primary btn-sm"
                        }
                    },
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                }
            }).buttons().container().appendTo('#users_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('users.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
