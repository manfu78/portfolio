@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.CoinType.CoinTypes') }} @endsection
@section('pagetitle') {{ trans('messages.CoinType.CoinTypes') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            @can('coinTypes.create')
                <div>
                    <div class="btn-group">
                        <a href="{{ route('admin.coinTypes.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.CoinType.NewCoinType') }}
                        </a>
                    </div>
                </div>
            @else
                <h1 class="page-title">&nbsp;</h1>
            @endcan
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.CoinType.CoinTypes') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.CoinType.CoinTypes') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="coinTypes_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0" style="width: 10px;">#</th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Code') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Sign') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Sign') }}&nbsp;HTML</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Equivalence') }}</small></th>
                                        <th class="border-bottom-0" style="width: 10px;"><small>{{ trans('messages.DefaultCoin') }}</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coinTypes as $coinType)
                                        <tr>
                                            <td class="py-1 text-end" style="width: 10px;"><small>#</small>{{ $coinType->id }}</td>
                                            <td class="py-1">{{ $coinType->code }}</td>
                                            <td class="py-1"><span class="fw-bold">{{ $coinType->sign }}</span></td>
                                            <td class="py-1">{{ $coinType->sign_html }}</td>
                                            <td class="py-1">{{ $coinType->equivalence }}</td>
                                            <td class="py-1 text-center" style="width: 10px;">
                                                {!! $coinType->default?'<i class="fa-solid fa-circle text-success"></i>':'-' !!}
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('coinTypes.edit')
                                                    <a href="{{ route('admin.coinTypes.edit', $coinType) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                 @else
                                                    <button class="btn text-default btn-sm py-0 disabled"><i class="fe fe-edit"></i></button>
                                                @endcan
                                                @can('coinTypes.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $coinType->name }}"
                                                        data-route="{{ route('admin.coinTypes.destroy',$coinType->id) }}">
                                                        <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                            <i class="fe fe-trash"></i>
                                                        </div>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-icon btn-danger disabled"><i class="fe fe-trash"></i></button>
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
    @can('coinTypes.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#coinTypes_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [6] },
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
            }).buttons().container().appendTo('#coinTypes_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('coinTypes.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
