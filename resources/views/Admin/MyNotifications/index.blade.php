@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Notification.Notifications') }} @endsection
@section('pagetitle') {{ trans('messages.Notification.Notifications') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.MyNotifications') }}</small></li>
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
                                        <th class="border-bottom-0" style="width: 10px;"><small>id</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Date') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Notification.Notification') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Description') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.ReadedDate') }}</small></th>
                                        <th class="border-bottom-0" style="width: 30px;text-align: center;"><i class="fa-solid fa-paperclip"></i></th>
                                        <th class="border-bottom-0" style="width: 30px;text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td class="py-1" style="width: 10px;">{{ $notification->id }}</td>
                                            <td class="py-1 no-wrap" style="width: 10px;">
                                                <span class="d-none">{{ date('Y/m/d h:i',strtotime($notification->date)) }}</span>
                                                {{ date('d/m/Y h:i',strtotime($notification->date)) }}</div>
                                            </td>
                                            <td class="py-1">
                                                {{ $notification->name }}
                                            </td>
                                            <td class="py-1">
                                                {{ $notification->description }}
                                            </td>
                                            <td class="py-1">
                                                @if ($notification->readed_date)
                                                    <span class="d-none">{{ date('Y/m/d m:i',strtotime($notification->readed_date)) }}</span>
                                                    {{ date('d/m/Y m:i',strtotime($notification->readed_date)) }}</div>
                                                @endif
                                            </td>
                                            <td class="py-1 text-center">
                                                @if ($notification->route)
                                                    <a href="{{ Storage::url($notification->route) }}"><i class="fa-solid fa-link"></i></a>
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 30px;text-align: center;">
                                                <span class="d-none">{{ $notification->readed }}</span>
                                                @if ($notification->readed===0)
                                                    <a href="{{ route('admin.myNotifications.markAsRead',[$notification->id,'ubi'=>base64_encode("admin.myNotifications")]) }}" class="text-danger"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ __('Mark as read') }}">
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </a>
                                                @else
                                                    <span class="text-muted">
                                                        <i class="fa-solid fa-envelope-open"></i>
                                                    </span>
                                                @endif
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
                    { orderable: false, targets: [5] },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 6 },
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
