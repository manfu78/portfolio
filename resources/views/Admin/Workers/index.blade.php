@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Worker.Workers') }} @endsection
@section('pagetitle') {{ trans('messages.Worker.Workers') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Worker.Workers') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body py-2">
                        <div class="row">
                            <ul class="nav nav-pills">
                                @can('workers.create')
                                    <li class="nav-item">
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.workers.create') }}">
                                            <span class="nav-link-icon d-block"><i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Worker.NewWorker') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('messages.View') }}&nbsp;{{ $selectedStatus }}</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.workers.index') }}?status=all{{ $isCommercial?'&is_commercial='.$isCommercial:'' }}">{{ trans('messages.All') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.workers.index') }}?status=1{{ $isCommercial?'&is_commercial='.$isCommercial:'' }}">{{ trans('messages.Actives') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.workers.index') }}?status=0{{ $isCommercial?'&is_commercial='.$isCommercial:'' }}">{{ trans('messages.NoActives') }}</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown m-2">
                                    <a class="nav-link dropdown-toggle px-4" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('messages.Commercial') }}&nbsp;({{ $selectedIsCommercial }})</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.workers.index') }}?is_commercial=1{{ $status?'&status='.$status:'' }}">{{ trans('messages.IsCommercial') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.workers.index') }}?is_commercial=0{{ $status?'&status='.$status:'' }}">{{ trans('messages.NotCommercial') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.workers.index').$status?'?status='.$status:'' }}">{{ trans('messages.All') }}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.Worker.Workers') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="workers_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 10px;">#</th>
                                        <th class="border-bottom-0" style="width: 10px;"></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Lastname') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Phone') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Email') }}</small></th>
                                        <th class="border-bottom-0" style="width: 10px;"><small>Loc.</th>
                                        <th class="border-bottom-0" style="width: 30px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($workers as $worker)
                                        <tr>
                                            <td class="py-1" style="width: 10px;"> <small>#{{ $worker->id }} </small></td>
                                            <td class="py-1" style="width: 30px;">
                                                @if ($worker->photo)
                                                    <span class="avatar avatar-sm brround cover-image" data-bs-image-src="{{ Storage::url($worker->photo) }}"
                                                        @if ($worker->user)
                                                            data-bs-placement="top"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ $worker->user->email }}"
                                                        @endif>
                                                        @if ($worker->user)
                                                            <span class="avatar-status bg-green"></span>
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="avatar avatar-sm brround cover-image" data-bs-image-src="/assets/images/profileimg.png"
                                                        @if ($worker->user)
                                                            data-bs-placement="top"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ $worker->user->email }}"
                                                        @endif>
                                                        @if ($worker->user)
                                                            <span class="avatar-status bg-green"></span>
                                                        @endif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-1"><span class="fw-bold">{{$worker->name}}</span></td>
                                            <td class="py-1"><span>{{$worker->lastname}}</span></td>
                                            <td class="py-1"><a href="tel:{{$worker->phone}}">{{$worker->phone}}</a></td>
                                            <td class="py-1"><a href="mailto:{{$worker->email}}">{{$worker->email}}</a></td>
                                            <td class="py-1">
                                                @if ($worker->latitude&&$worker->longitude)
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $worker->latitude }}%2C{{ $worker->longitude }}" target="_blank"><i class="fas fa-map-pin"></i></a>
                                                @else
                                                    @if ($worker->address)
                                                        <a href="https://www.google.com/maps/search/?api=1&query={{$worker->address}}%2C+{{$worker->postal_code}}%2C+{{$worker->city}}%2C+{{$worker->province}}" target="_blank"><i class="fas fa-map-marked-alt"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('workers.edit')
                                                    <a href="{{ route('admin.workers.edit', $worker) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('workers.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $worker->full_name }}"
                                                        data-route="{{ route('admin.workers.destroy',$worker->id) }}">
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
    @can('workers.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#workers_table").DataTable({
            "columns": [
                { "orderable": false },
                { "orderable": false },
                null,
                null,
                null,
                null,
                null,
                { "orderable": false }
            ],
            "columnDefs": [
                {
                    "responsivePriority": 1, "targets": 0,
                    "responsivePriority": 1, "targets": 7,
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
            }).buttons().container().appendTo('#workers_table_wrapper .col-md-6:eq(0)');
        });
    </script>
    @can('workers.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
