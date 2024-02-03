@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Document.Documents') }} @endsection
@section('pagetitle') {{ trans('messages.Document.Document') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="row d-print-none">
            <div class="col-12">
                <div class="page-header">
                    {{-- @can('channels.create')
                        <ul class="nav nav-pills nav-pills-circle mr-3" id="tabs_2" customer="tablist">
                            <li class="nav-item">
                                <a class="me-2 btn btn-sm btn-outline-primary" href="{{ route('admin.documents.create') }}">
                                    <span class="nav-link-icon d-block"><i class="fe fe-file-plus"></i> {{ trans('messages.Document.NewDocument') }}</span>
                                </a>
                            </li>
                        </ul>
                    @else --}}
                        <h1 class="page-title">&nbsp;</h1>
                    {{-- @endcan --}}
                        {{-- <h1 class="page-title">{{ trans('messages.Document.Documents') }}</h1> --}}
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>{{ trans('messages.Home.Home') }}</small></a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Document.Documents') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @include('Admin.DocumentManagement.Documents.Partials.menu')

        <div class="row d-print-none">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <i class="fa-solid fa-filter"></i>&nbsp;{{ trans('messages.Filter') }}
                    </div>
                    <form action="{{ route('admin.documents.index') }}" method="GET" name="form_documents_filter" id="form_documents_filter">
                        @csrf
                        @method('GET')
                        <div class="card-body py-3">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                                    <div class="form-group m-0">
                                        <small>{{ trans('messages.FromDate') }}</small>
                                        <input type="date" name="from_date" id="from_date" value="{{ $fromDate }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                                    <div class="form-group m-0">
                                        <small>{{ trans('messages.ToDate') }}</small>
                                        <input type="date" name="to_date" id="to_date" value="{{ $toDate }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group m-0">
                                        <label class="form-label m-0">
                                            <small> {{ trans('messages.Type') }}</small>
                                        </label>
                                        <select name="document_type_id" id="document_type_id" class="form-control form-select" placeholder="{{ trans('messages.All'), }}" style="width: 100%">
                                            @foreach($documentTypeSelect as $documentTypeId => $documentTypeName)
                                                <option value="{{ $documentTypeId }}" {{ $documentTypeId == $documentTypeSelected? 'selected' : '' }}>
                                                    {{ $documentTypeName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group m-0">
                                        <label class="form-label m-0">
                                            <small> {{ trans('messages.Business.Business') }}</small>
                                        </label>
                                        <select name="business_id" id="business_id" class="form-control business-show-search form-select business " placeholder="{{ trans('messages.SelectBusiness') }}" style="width: 100%">
                                            @foreach($businessSelect as $businessId => $businessName)
                                                <option value="{{ $businessId }}" {{ $businessId == $businessSelected ? 'selected' : '' }}>
                                                    {{ $businessName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-6">
                                    <div class="form-group m-0">
                                        <label class="form-label m-0">
                                            <small> {{ trans('messages.Worker.Workers') }}</small>
                                        </label>
                                        <select name="worker_id" id="worker_id" class="form-control worker-show-search form-select worker " placeholder="{{ trans('messages.SelectWorker') }}" style="width: 100%">
                                            @foreach($workerSelect as $workerSelectId => $workerSelectName)
                                                <option value="{{ $workerSelectId }}" {{ $workerSelectId == $workerSelected ? 'selected' : '' }}>
                                                    {{ $workerSelectName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12 text-end">
                                    <div class="btn-group m-0">
                                        <button class="btn btn-sm btn-outline-success" type="submit">
                                            <i class="fe fe-search"></i>&nbsp;
                                            {{ trans('messages.Filter') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <i class="fa-regular fa-comments"></i>&nbsp;{{ trans('messages.Document.Documents') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="documents_table" class="table table-bordered border-bottom">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Date') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.Type') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.File') }}</small></th>
                                        <th class="border-bottom-0"><small>{{ trans('messages.LinkedTo') }}</small></th>
                                        <th class="border-bottom-0 d-print-none"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                        <tr>
                                            <td class="py-1" style="width: 10px;">{{ $document->id }}</td>
                                            <td class="py-1">
                                                <div class="fw-bold">
                                                    <span class="d-none">{{ date('Y/m/d',strtotime($document->date)) }}</span>
                                                    {{ date('d/m/Y',strtotime($document->date)) }}
                                                </div>
                                            </td>
                                            <td class="py-1">{{ $document->name }}</td>
                                            <td class="py-1">{{ $document->documentType->type  }}</td>
                                            <td class="py-1 text-center">
                                                @if ($document->file!=null)
                                                    <a href="{{  Storage::url($document->file) }}" target="_blank"><i class="fa-solid fa-file-lines"></i></a>
                                                @endif
                                            </td>
                                            <td class="py-1">
                                                <a href="{{ $document->getRoute()!=null?$document->getRoute():'#' }}">
                                                    {{ $document->getModelName() }}:&nbsp;
                                                    {{ $document->documentable_type::find($document->documentable_id)->name }}
                                                </a>
                                                <div class="d-none">
                                                    <table class="table text-nowrap text-md-nowrap my-2 table-borderless table-hover">
                                                        @if ($document->customer)
                                                            <tr class="table-light">
                                                                <td class="p-1">{{ trans('messages.Customer.Customer') }}</td>
                                                                <td class="p-1"><a href="{{ route('admin.customers.edit',$document->customer_id) }}">{{ $document->customer->name }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if ($document->worker)
                                                            <tr class="">
                                                                <td class="p-1">{{ trans('messages.Worker.Worker') }}</td>
                                                                <td class="p-1"><a href="{{ route('admin.workers.edit',$document->worker_id) }}">{{ $document->worker->full_name }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if ($document->business)
                                                            <tr class="table-light">
                                                                <td class="p-1">{{ trans('messages.Business.Business') }}</td>
                                                                <td class="p-1"><a href="{{ route('admin.businesses.edit',$document->business_id) }}">{{ $document->business->name }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if ($document->project)
                                                            <tr class="table-light">
                                                                <td class="p-1">{{ trans('messages.Project.Project') }}</td>
                                                                <td class="p-1"><a href="{{ route('admin.projects.edit',$document->project_id) }}">{{ $document->project->name }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if ($document->projectChore)
                                                            <tr class="table-light">
                                                                <td class="p-1">{{ trans('messages.ProjectChore.ProjectChore') }}</td>
                                                                <td class="p-1"><a href="{{ route('admin.projectChores.edit',$document->project_chore_id) }}">{{ $document->projectChore->name }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if ($document->opportunity)
                                                            <tr class="table-light">
                                                                <td class="p-1">{{ trans('messages.Opportunity.Opportunity') }}</td>
                                                                <td class="p-1"><a href="{{ route('admin.opportunities.edit',$document->opportunity_id) }}">{{ $document->opportunity->name }}</a></td>
                                                            </tr>
                                                        @endif
                                                        @if ($document->expense)
                                                            <tr class="table-light">
                                                                <td class="p-1">{{ trans('messages.Expense.Expense') }}</td>
                                                                <td class="p-1">
                                                                    <a href="{{ route('admin.expenses.edit',$document->expense_id) }}">
                                                                        {{ $document->expense->name }}&nbsp;
                                                                        (
                                                                        {{ number_format(($document->expense->total), 2, ',','.') }}&nbsp;
                                                                        {{ $document->expense->coinType->sign }}
                                                                        )
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </table>
                                                </div>
                                            </td>


                                            <td class="py-1 text-nowrap d-print-none" style="width: 60px;">
                                                <div class="text-end">
                                                    @can('documents.edit')
                                                        <a href="{{ route('admin.documents.edit',$document) }}"
                                                            class="btn text-default btn-sm py-0"
                                                            data-bs-placement="top"
                                                            data-bs-toggle="tooltip"
                                                            title="{{ trans('messages.Edit') }}" disabled>
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn text-default btn-sm py-0 disabled">
                                                            <i class="fe fe-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @can('documents.destroy')
                                                        <a class="modal-effect btn text-danger btn-sm py-0"
                                                            data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                            data-name="{{ $document->name }}"
                                                            data-route="{{ route('admin.documents.destroy',$document->id) }}">
                                                            <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                                <i class="fe fe-trash"></i>
                                                            </div>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-icon btn-danger disabled">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    @endcan
                                                </div>
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
    </div>
    @can('documents.destroy')
    @include('layouts.admin.modal.delete-reg-html')
@endcan
@endsection

@section('page_css')<style> .tooltip{position: absolute;z-index:9999;} </style>@endsection

@section('scripts_js')
@include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#documents_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [6] },
                    { responsivePriority: 1, targets: 1 },
                    { responsivePriority: 1, targets: 6 },
                ],
                "order": [[0, 'desc']],
                "responsive": false,
                "lengthChange": true,
                "lengthMenu": [
                        [10, 25, 50, 75, -1],
                        [10, 25, 50, 75, 'All'],
                    ],
                "pageLength": 50,
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
                    "buttons": ["excel","print"],
                }
            }).buttons().container().appendTo('#documents_table_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(function(e) {
            "use strict";

            // Worker
            $('.worker').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.worker-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%'
            });
            $('.worker').on('click', () => {
                let selectField = document.querySelectorAll('.select2-search__field')
                selectField.focus();
                selectField.forEach((element, index) => {
                    element.focus();
                })
            });


            // Businesss
            $('.business').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.business-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%'
            });
            $('.business').on('click', () => {
                let selectField = document.querySelectorAll('.select2-search__field')
                selectField.focus();
                selectField.forEach((element, index) => {
                    element.focus();
                })

            });
        });
    </script>
    @can('documents.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
