@extends('layouts.admin.app')

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            @can('roles.create')
                <ul class="nav nav-pills nav-pills-circle mr-3" id="tabs_2" customer="tablist">
                    <li class="nav-item">
                        <a class="me-2 btn btn-sm btn-outline-primary" href="{{ route('admin.roles.create') }}">
                            <span class="nav-link-icon d-block"><i class="fe fe-file-plus"></i> {{ trans('messages.Role.NewRole') }}</span>
                        </a>
                    </li>
                </ul>
            @else
                <h1 class="page-title">&nbsp;</h1>
            @endcan
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>Roles</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.Role.Roles') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="roles_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0"><small>id</small></th>
                                        <th class="border-bottom-0"><small>Rol</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td class="py-1 text-end" style="width: 10px;">{{$role->id}}</td>
                                            <td class="py-1">
                                                <span class="fw-bold">{{$role->name}}</span>
                                            </td>
                                            <td class="py-1" style="width: 10px;text-align: right;">
                                                @can('roles.edit')
                                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @else
                                                    <button class="btn text-default btn-sm  py-0" disabled><i class="fe fe-edit"></i></button>
                                                @endcan
                                                @can('roles.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $role->name }}"
                                                        data-route="{{ route('admin.roles.destroy',$role->id) }}">
                                                        <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                            <i class="fe fe-trash"></i>
                                                        </div>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-icon btn-danger py-0 disabled"><i class="fe fe-trash"></i></button>
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
    @can('roles.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('sectiontitle') Roles @endsection
@section('page_css') @endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#roles_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: 2 },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 2 },
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
            }).buttons().container().appendTo('#roles_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('roles.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
