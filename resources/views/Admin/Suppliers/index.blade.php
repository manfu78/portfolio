@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Supplier.Suppliers') }} @endsection
@section('pagetitle') {{ trans('messages.Supplier.Suppliers') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>{{ trans('messages.Home.Home') }}</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Supplier.Suppliers') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body py-2">
                        <div class="row">
                            <ul class="nav nav-pills">
                                @can('suppliers.create')
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.suppliers.create') }}">
                                            <span class="nav-link-icon d-block"><i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Supplier.NewSupplier') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('messages.View') }}&nbsp;{{ $selectedStatus }}</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.suppliers.index') }}?status=1">{{ trans('messages.Actives') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.suppliers.index') }}?status=0">{{ trans('messages.NoActives') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.suppliers.index') }}">{{ trans('messages.All') }}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.Supplier.Suppliers') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="suppliers_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 10px;"><small>#</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Phone') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Email') }}</small></th>
                                        <th class="border-bottom-0"><small>Loc.</small></th>
                                        <th class="border-bottom-0" style="width: 30px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $supplier)
                                        <tr @if (!$supplier->status) class="bg-warning-transparent" @endif>
                                            <td class="py-1 text-end" style="width: 10px;"><small>#{{ $supplier->id }}</small></td>
                                            <td class="py-1">
                                                <a href="{{ route('admin.suppliers.edit',$supplier) }}">
                                                    <span class="fw-bold">{{$supplier->name}}</span>
                                                </a>
                                            </td>
                                            <td class="py-1"><a href="tel:{{$supplier->phone}}">{{$supplier->phone}}</a></td>
                                            <td class="py-1"><a href="mailto:{{$supplier->email}}">{{$supplier->email}}</a></td>
                                            <td class="py-1">
                                                @if ($supplier->address)
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{$supplier->address}}%2C+{{$supplier->postal_code}}%2C+{{$supplier->city}}%2C+{{$supplier->province}}" target="_blank"><i class="fas fa-map-marked-alt"></i></a>
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('suppliers.edit')
                                                    <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('suppliers.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $supplier->name }}"
                                                        data-route="{{ route('admin.suppliers.destroy',$supplier->id) }}">
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
    @can('suppliers.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#suppliers_table").DataTable({
            "columns": [
                { "orderable": false },
                null,
                null,
                null,
                null,
                { "orderable": false }
            ],
            "columnDefs": [
                {
                    "responsivePriority": 1, "targets": 0,
                    "responsivePriority": 1, "targets": 5,
                },
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
            }).buttons().container().appendTo('#suppliers_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('suppliers.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
