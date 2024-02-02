@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditBusiness') }} @endsection
@section('pagetitle') {{ trans('messages.Business.Business') }} @endsection

@section('page_css')
    <style>
        .border-perso {
            border-bottom: 1px solid #ced4da;
            border-left: 1px solid #ced4da;
            border-top: 0px solid #ced4da;
            border-right: 0px solid #ced4da;
            border-radius: 0px 0px 0px 7px;
        }
    </style>
@endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">
                <ul class="nav nav-pills nav-pills-circle mr-3" id="tabs_2" customer="tablist">
                    @can('business.create')
                        <li class="nav-item">
                            <a class="me-2 btn btn-sm btn-outline-primary" href="{{ route('admin.businesses.create') }}">
                                <span class="nav-link-icon d-block"><i class="fe fe-file-plus"></i> {{ trans('messages.Business.NewBusiness') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('business.edit')
                        <li class="nav-item">
                            <a class="me-2 btn btn-sm btn-outline-primary" href="{{ route('admin.businesses.edit',$business) }}">
                                <span class="nav-link-icon d-block"><i class="fa-solid fa-file-pen"></i> {{ trans('messages.Business.EditBusiness') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
                &nbsp;
            </h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.businesses.index') }}">{{ trans('messages.Business.Businesses') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Business.ViewBusiness') }}</li>
                </ol>
            </div>
        </div>

        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <span class="fw-bold"><i class="fa-solid fa-building"></i></span>&nbsp;{{ trans('messages.Business.Business') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                @if ($business->logo)
                                    <img id="business-img" src="{{ Storage::url($business->logo) }}" class="img-responsive br-5" style="width: 100px;">
                                @else
                                    <img id="business-img" src="/assets/images/nophoto.jpeg" class="img-responsive br-5" style="width: 100px;">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="card-title">
                                    <span class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('messages.Information') }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>{{ trans('messages.Name') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->name }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>{{ trans('messages.Tradename') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->tradename }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <small>CIF</small>
                                    <div class="form-control border-perso">
                                        {{ $business->cif }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <small>{{ trans('messages.Phone') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->phone }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <small>{{ trans('messages.Email') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->email }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="card-title">
                                    <span class="card-title fw-bold"><i class="fe fe-map"></i>&nbsp;{{ trans('messages.Address') }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                <div class="form-group">
                                    <small>{{ trans('messages.Address') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->address }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="form-group">
                                    <small>C.P.</small>
                                    <div class="form-control border-perso">
                                        {{ $business->postal_code }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                                <div class="form-group">
                                    <small>{{ trans('messages.City') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->city }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                                <div class="form-group">
                                    <small>{{ trans('messages.Province') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->province }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>{{ trans('messages.Country.Country') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->country?$business->country->name:'' }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="card-title">
                                    <span class="card-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.OtherData') }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>{{ trans('messages.Vat.Vat') }}</small>
                                    <div class="form-control border-perso">
                                        {{ $business->vat?$business->vat->description:'' }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @if ($business->documents->count()>0||$business->expenses->count()>0)
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <h3 class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('messages.Files') }}</h3>
                        </div>
                        <div class="card-body py-2">
                            @if ($business->documents->count()>0)
                                <div class="row mt-4 mb-3 pt-4 border-bottom">
                                    <div class="col-12">
                                        <span class="h5 text-primary"><i class="fa-regular fa-file-lines"></i>&nbsp;{{ trans('messages.Files') }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="documents_table" class="table mb-0">
                                                <thead>
                                                    <tr class="bg-primary-transparent">
                                                        <th class="p-2"><small>{{ trans('messages.Name') }}</small></th>
                                                        <th class="p-2"><small>{{ trans('messages.Description') }}</small></th>
                                                        <th class="p-2"><small>{{ trans('messages.Type') }}</small></th>
                                                        <th class="p-2 text-center"><small><i class="fa-solid fa-file-lines"></i></small></th>
                                                        <th class="p-2"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($business->documents as $businessDocument)
                                                        <tr>
                                                            <td><span>{{ $businessDocument->name }}</span></td>
                                                            <td><span>{{ $businessDocument->description }}</span></td>
                                                            <td><span>{{ $businessDocument->documentType->type }}</span></td>
                                                            <td class="text-center">
                                                                <a href="{{ Storage::url( $businessDocument->file) }}" target="_blank">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-nowrap" style="width: 60px;text-align: right;">
                                                                <a class="modal-effect btn text-danger btn-sm py-0"
                                                                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                                    data-name="{{ $businessDocument->name }}"
                                                                    data-route="{{ route('admin.opportunities.deleteDocument',$businessDocument->id) }}">
                                                                    <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                                        <i class="fe fe-trash"></i>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($business->expenses->count()>0)
                                <div class="row mt-4 mb-3 pt-4 border-bottom">
                                    <div class="col-12">
                                        <span class="h5 text-primary"><i class="fa-regular fa-file-lines"></i>&nbsp;{{ trans('messages.Expense.Expenses') }}</span>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="documents_table" class="table mb-0">
                                                <thead>
                                                    <tr class="bg-primary-transparent">
                                                        <th class="p-2"><small>{{ trans('messages.Name') }}</small></th>
                                                        <th class="p-2"><small>{{ trans('messages.Description') }}</small></th>
                                                        <th class="p-2"><small>{{ trans('messages.Amount') }}</small></th>
                                                        <th class="p-2 text-center"><small><i class="fa-solid fa-file-lines"></i></small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($business->expenses as $businessExpense)
                                                        <tr>
                                                            <td><span>{{ $businessExpense->name }}</span></td>
                                                            <td><span>{{ $businessExpense->description }}</span></td>
                                                            <td><span>{{ $businessExpense->total.' '.$businessExpense->coinType->sign }}</span></td>
                                                            <td class="text-center">
                                                                @if ($businessExpense->documents->count()>0)
                                                                    <a href="{{ Storage::url( $businessExpense->documents->first()->file) }}" target="_blank">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
<script>
    $(function () {
        $("#modal_bank_account_table").DataTable({
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
            $('#logo').change(function(e){
                let file= e.target.files[0];
                let reader= new FileReader();
                reader.onload= (event) => {
                    $('#business-img').attr('src', event.target.result)
                };
                reader.readAsDataURL(file);
            })
        });
    </script>
@endsection
