@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Business.Businesses') }} @endsection
@section('pagetitle') {{ trans('messages.Business.Businesses') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            @can('businesses.create')
                <div>
                    <div class="btn-group">
                        <a href="{{ route('admin.businesses.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Business.NewBusiness') }}
                        </a>
                    </div>
                </div>
            @else
                <h1 class="page-title">&nbsp;</h1>
            @endcan
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Business.Businesses') }}</small></li>
                </ol>
            </div>
        </div>

        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.Business.Businesses') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="businesses_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0"><small>Logo</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Phone') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Email') }}</small></th>
                                        <th class="border-bottom-0"><small>Loc.</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($businesses as $business)
                                        <tr>
                                            <td class="py-1"><small>#{{ $business->id }}</small></td>
                                            <td class="py-1 text-center">
                                                @if ($business->logo)
                                                    <span class="avatar avatar-sm cover-image" data-bs-image-src="{{ Storage::url($business->logo) }}"></span>
                                                @else
                                                    <span class="avatar avatar-sm cover-image" data-bs-image-src="/assets/images/nophoto.jpeg"></span>
                                                @endif
                                            </td>
                                            <td class="py-1">
                                                <a href="{{ route('admin.businesses.show',$business) }}">
                                                    <span class="fw-bold">{{$business->name}}</span>
                                                </a>
                                            </td>
                                            <td class="py-1"><a href="tel:{{$business->phone}}">{{$business->phone}}</a></td>
                                            <td class="py-1"><a href="mailto:{{$business->email}}">{{$business->email}}</a></td>
                                            <td class="py-1">
                                                @if ($business->address)
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{$business->address}}%2C+{{$business->postal_code}}%2C+{{$business->city}}%2C+{{$business->province}}" target="_blank"><i class="fas fa-map-marked-alt"></i></a>
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('businesses.edit')
                                                    <a href="{{ route('admin.businesses.edit', $business) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('businesses.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $business->name }}"
                                                        data-route="{{ route('admin.businesses.destroy',$business->id) }}">
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
    @can('businesses.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#businesses_table").DataTable({
            "columns": [
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
                    "responsivePriority": 1, "targets": 6,
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
            }).buttons().container().appendTo('#businesses_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('businesses.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
