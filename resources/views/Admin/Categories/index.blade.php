@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Category.Categories') }} @endsection
@section('pagetitle') {{ trans('messages.Category.Categories') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            @can('categories.create')
                <div>
                    <div class="btn-group">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Category.NewCategory') }}
                        </a>
                    </div>
                </div>
            @else
                <h1 class="page-title">&nbsp;</h1>
            @endcan
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Category.Categories') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.Category.Categories') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="categories_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 10px;"><small>#</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.HourPrice') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.UnitPrice') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Details') }}</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="py-1" style="width: 10px;"><small>#{{ $category->id }}</small></td>
                                            <td class="py-1"><span class="fw-bold">{{ $category->name }}</span></td>
                                            <td class="py-1">{{ number_format(( $category->hour_price ), 2, ',','.') }}&nbsp;&euro;</td>
                                            <td class="py-1">{{ number_format(( $category->unit_price ), 2, ',','.') }}&nbsp;&euro;</td>
                                            <td class="py-1">{{ $category->details }}</td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('categories.edit')
                                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('categories.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $category->name }}"
                                                        data-route="{{ route('admin.categories.destroy',$category->id) }}">
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
    @can('categories.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#categories_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [5] },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 5 },
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
            }).buttons().container().appendTo('#categories_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('categories.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
