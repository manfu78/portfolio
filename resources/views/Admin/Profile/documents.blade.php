@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Worker.EditWorker') }} @endsection
@section('pagetitle') {{ trans('messages.Worker.Worker') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.profile.show') }}">{{ trans('messages.Profile') }}</a></li>
                </ol>
            </div>
        </div>

        @include('Admin.Profile.Partials.menu')

        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card" id="user_profile_documents">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col">
                                <div class="media d-flex">
                                    @if ($worker->photo)
                                        <span class="me-2">
                                            <img id="photo" class="avatar brround cover-image" src="{{ Storage::url($worker->photo) }}" onerror="this.src='/assets/images/profileimg.png'" style="width: 75px;height: 75px;object-fit: cover;">
                                        </span>
                                    @else
                                        <span class="avatar avatar-xxl brround bg-default mx-4">
                                            {{ substr($worker->name,0,1).substr($worker->lastname,0,1) }}
                                        </span>
                                    @endif
                                    <div class="media-body">
                                        <h4 class="font-weight-semibold mb-1">{{ $worker->full_name }}</h4>
                                        @if ($worker->phone)
                                            <span><a href="Tel:{{ $worker->phone }}"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;{{ $worker->phone }}</a></span>
                                        @endif
                                        @if ($worker->email)
                                            <p class="m-0">
                                                <a href="mailto:{{$worker->email}}"><small><i class="fa-solid fa-envelope"></i>:</small>&nbsp;{{$worker->email}}</a>
                                            </p>
                                        @endif
                                        @if ($worker->phone)
                                            <p class="m-0">
                                                <a href="tel:{{$worker->phone}}"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;{{$worker->phone}}</a>
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-2">
                        @can('documents.create')
                            <div class="row mb-4">
                                <div class="col">
                                    <button type="button" class="modal-effect btn btn-sm btn-outline-success text-uppercase"
                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalAddFile">
                                        <span class="fa fa-plus"></span>&nbsp;&nbsp;{{ trans('messages.New') }}
                                    </button>
                                </div>
                            </div>
                        @endcan


                        @if ($worker->documents->count()>0)
                            <div class="table-responsive">
                                <table id="documents_table" class="table table-bordered border-bottom">
                                    <thead>
                                        <tr class="bg-primary-transparent">
                                            <th class="p-2" style="width: 10px;"><small>id</small></th>
                                            <th class="p-2"><small>{{ trans('messages.Date') }}</small></th>
                                            <th class="p-2"><small>{{ trans('messages.Name') }}</small></th>
                                            <th class="p-2"><small>{{ trans('messages.Type') }}</small></th>
                                            <th class="p-2 text-center" style="width: 30px;"><small><i class="fa-solid fa-file-lines"></i></small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($worker->documents as $workerDocument)
                                            <tr>
                                                <td class="py-1 fw-bold" style="width: 10px;">{{ $workerDocument->id }}</td>
                                                <td class="py-1" style="width: 50px;"><span>{{ date('m/d/Y', strtotime($workerDocument->created_at)) }}</span></td>
                                                <td class="py-1"><span>{{ $workerDocument->name }}</span></td>
                                                <td class="py-1"><span>{{ $workerDocument->documentType->type }}</span></td>
                                                <td class="py-1 text-center"  style="width: 30px;">
                                                    <a href="{{ Storage::url( $workerDocument->file) }}" target="_blank">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row">
                                <div class="col text-center">
                                    {{ trans('messages.Info.NoRecordsFound') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Modal para añadir fichero --}}
                <div class="modal fade" id="modalAddFile">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header bg-primary-transparent py-1">
                                <h5 class="modal-title fw-bold"><i class="fa-solid fa-file"></i>&nbsp;{{ trans('messages.Document.Document') }}</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            {!! Form::open(array('route'=>['admin.workers.addDocument',$worker],'method'=>'POST','name'=>'form_add_document','enctype'=>'multipart/form-data')) !!}
                            @csrf
                                <div class="modal-body">
                                    @include('Admin.DocumentManagement.Documents.Partials.form-documents')
                                </div>
                                <div class="modal-footer py-1">
                                    <button class="btn btn-sm ripple btn-outline-success" type="submit">
                                        <span class="fa fa-save"></span>&nbsp;{{ trans('messages.Save') }}
                                    </button>
                                    <button class="btn btn-sm ripple btn-outline-default" data-bs-dismiss="modal" type="button">
                                        <span class="fa fa-close"></span>&nbsp;{{ trans('messages.Cancel') }}
                                    </button>
                                </div>
                            {!! Form::close() !!}
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
            $("#documents_table").DataTable({
            "columns": [
                { "orderable": false },
                null,
                null,
                null,
                { "orderable": false },
            ],
            "columnDefs": [
                {
                    "responsivePriority": 1, "targets": 0,
                    "responsivePriority": 1, "targets": 4,
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
    @can('workers.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
