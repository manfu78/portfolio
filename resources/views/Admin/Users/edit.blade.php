@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditUser') }} @endsection
@section('pagetitle') {{ trans('messages.User.User') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('messages.User.Users') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.User.EditUser') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.users.update',$user) }}" method="post" name="form_users_update">
                    @csrf
                    @method('PUT')
                    @include('Admin.Users.Partials.form')
                </form>
            </div>
            @include('Admin.Users.Partials.modal_worker')
        </div>
    </div>
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
<script>
    $(function () {
        $("#workers_table").DataTable({
        "columnDefs": [
            { orderable: false, targets: [0,2] }
        ],
        "order": [[1, 'asc']],
        "responsive": true,
        "lengthChange": true,
        "lengthMenu": [ 5, 10 ],
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
        }).buttons().container().appendTo('#users_table_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
