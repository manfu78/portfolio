@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Customer.EditCustomer') }} @endsection
@section('pagetitle') {{ trans('messages.Customer.Customers') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">{{ trans('messages.Customer.Customers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Customer.EditCustomer') }}</li>
                </ol>
            </div>
        </div>

        @include('Admin.Customers.Partials.menu')

        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                @include('Admin.Customers.Partials.form_documents')
            </div>
        </div>

    </div>
    @can('customers.edit')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#documents_table").DataTable({
            "columns": [
                { "orderable": false },
                null,
                null,
                null,
                { "orderable": false },
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
            }).buttons().container().appendTo('#documents_table_wrapper .col-md-6:eq(0)');
        });
    </script>
    @can('customers.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
