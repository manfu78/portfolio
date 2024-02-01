@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditWorker') }} @endsection
@section('pagetitle') {{ trans('messages.Worker.Worker') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.workers.index') }}">{{ trans('messages.Worker.Workers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Worker.EditWorker') }}</li>
                </ol>
            </div>
        </div>

        @include('Admin.Workers.Partials.menu')

        <div class="row " id="edit_worker">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.workers.update',$worker) }}" method="post" name="form_worker_update" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('Admin.Workers.Partials.form_worker_photo')
                    @include('Admin.Workers.Partials.form_worker_user_asign')
                    @include('Admin.Workers.Partials.form_worker_information')
                    @include('Admin.Workers.Partials.form_worker_address')
                    @include('Admin.Workers.Partials.form_worker_others')
                </form>

                @include('Admin.Workers.Partials.modal_workers')

                    <div class="card-footer">
                        <div class="row">
                            <div class="col text-center">
                                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.categories.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    @can('workers.edit')
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
            { orderable: false, targets: 2 }
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
<script>
    $(document).ready(function(){
        $('#photo').change(function(e){
            let file= e.target.files[0];
            let reader= new FileReader();
            reader.onload= (event) => {
                $('#worker-img').attr('src', event.target.result)
            };
            reader.readAsDataURL(file);
        })
    });
</script>
    @can('workers.edit')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
