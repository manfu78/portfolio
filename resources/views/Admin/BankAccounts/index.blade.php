@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.BankAccount.BankAccounts') }} @endsection
@section('pagetitle') {{ trans('messages.BankAccount.BankAccounts') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            @can('bankAccounts.create')
                <ul class="nav nav-pills nav-pills-circle mr-3" id="tabs_2" customer="tablist">
                    <li class="nav-item">
                        <a class="me-2 btn btn-sm btn-outline-primary" href="{{ route('admin.bankAccounts.create') }}">
                            <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.BankAccount.NewBankAccount') }}
                        </a>
                    </li>
                </ul>
            @else
                <h1 class="page-title">&nbsp;</h1>
            @endcan
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.BankAccount.BankAccounts') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-grip-vertical"></i></span>&nbsp;{{ trans('messages.BankAccount.BankAccounts') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="bankAccounts_table" class="table table-bordered text-nowrap border-bottom">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0"><small>id</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Phone') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Email') }}</small></th>
                                        <th class="border-bottom-0 text-center"><small>Loc.</small></th>
                                        <th class="border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bankAccounts as $bankAccount)
                                        <tr>
                                            <td class="py-1" style="width: 10px;">{{ $bankAccount->id }}</td>
                                            <td class="py-1"><span class="fw-bold">{{ $bankAccount->name }}</span></td>
                                            <td class="py-1"><span><a href="tel:{{$bankAccount->phone}}">{{ $bankAccount->phone }}</a></span></td>
                                            <td class="py-1"><span><a href="mailto:{{$bankAccount->email}}">{{ $bankAccount->email }}</a></span></td>
                                            <td class="py-1 text-center">
                                                @if ($bankAccount->address)
                                                    <a href="https://www.google.com/maps/place/{{$bankAccount->address}},+{{$bankAccount->postal_code}}+{{$bankAccount->city}},+{{$bankAccount->province}}" target="_blank"><i class="fas fa-map-marked-alt"></i></a>
                                                @endif
                                            </td>
                                            <td class="py-1" style="width: 60px;text-align: right;">
                                                @can('bankAccounts.edit')
                                                    <a href="{{ route('admin.bankAccounts.edit', $bankAccount) }}"
                                                        class="btn text-default btn-sm py-0"
                                                        data-bs-placement="top"
                                                        data-bs-toggle="tooltip"
                                                        title="{{ trans('messages.Edit') }}">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('bankAccounts.destroy')
                                                    <a class="modal-effect btn text-danger btn-sm py-0"
                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                        data-name="{{ $bankAccount->name }}"
                                                        data-route="{{ route('admin.bankAccounts.destroy',$bankAccount->id) }}">
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
    @can('bankAccounts.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#bankAccounts_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [4,5] },
                    { responsivePriority: 1, targets: 1 },
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
            }).buttons().container().appendTo('#bankAccounts_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('bankAccounts.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
