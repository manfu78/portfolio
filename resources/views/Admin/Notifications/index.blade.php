@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Notification.Notifications') }} @endsection
@section('pagetitle') {{ trans('messages.Notification.Notifications') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            @can('notifications.create')
                <div>
                    <div class="btn-group">
                        <a href="{{ route('admin.notifications.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Notification.NewNotification') }}
                        </a>
                    </div>
                </div>
            @else
                <h1 class="page-title">&nbsp;</h1>
            @endcan
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Notification.Notifications') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.Notification.Notifications') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="notifications_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 10px;"><small>#</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Date') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.For') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Notification.Notification') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Readed') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.ReadedDate') }}</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td class="py-1 text-end" style="width: 10px;"><small>#{{ $notification->id }}</small></td>
                                            <td class="py-1" style="width: 10px;">
                                                <span class="d-none">{{ date('Y/m/d h:i',strtotime($notification->date)) }}</span>
                                                {{ date('d/m/Y h:i',strtotime($notification->date)) }}</div>
                                            </td>
                                            <td class="py-1" style="width: 10px;"><span class="fw-bold">{{ $notification->user->nameWorker() }}</span></td>
                                            <td class="py-1">
                                                {{ $notification->name }}
                                            </td>
                                            <td class="py-1 text-center" style="width: 10px;">
                                                <span class="d-none">{{ $notification->readed }}</span>
                                                @if ($notification->readed)
                                                    <span class="text-success"><i class="fa-solid fa-circle"></i></span>
                                                @else
                                                    <span class="text-danger"><i class="fa-solid fa-circle"></i></span>
                                                @endif
                                            </td>
                                            <td class="py-1">
                                                @if ($notification->readed_date)
                                                    <span class="d-none">{{ date('Y/m/d',strtotime($notification->readed_date)) }}</span>
                                                    {{ date('d/m/Y',strtotime($notification->readed_date)) }}</div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($notification->route)
                                                    <a href="{{ Storage::url($notification->route) }}"><i class="fa-solid fa-link"></i></a>
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('notifications.edit')
                                                    <a href="{{ route('admin.notifications.edit', $notification) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @else
                                                    <button type="button" class="modal-effect btn text-default btn-sm py-0 disabled">
                                                        <i class="fe fe-edit"></i>
                                                    </button>
                                                @endcan
                                                @can('notifications.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $notification->name }}"
                                                        data-route="{{ route('admin.notifications.destroy',$notification->id) }}">
                                                        <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                            <i class="fe fe-trash"></i>
                                                        </div>
                                                    </a>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-icon btn-danger disabled">
                                                        <i class="fe fe-trash"></i>
                                                    </button>
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
    @can('notifications.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#notifications_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [6,7] },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 7 },
                ],
                "order": [[1, 'asc']],
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
            }).buttons().container().appendTo('#notifications_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('notifications.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
