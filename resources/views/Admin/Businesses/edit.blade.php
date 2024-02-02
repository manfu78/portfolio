@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditBusiness') }} @endsection
@section('pagetitle') {{ trans('messages.Business.Business') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fe fe-edit"></i>&nbsp;{{ trans('messages.Business.EditBusiness') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.businesses.index') }}">{{ trans('messages.Business.Businesses') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Business.EditBusiness') }}</li>
                </ol>
            </div>
        </div>
        @include('Admin.Businesses.Partials.menu')
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.businesses.update',$business) }}" method="post" name="form_business_update" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('Admin.Businesses.Partials.form_business_logo')
                    @include('Admin.Businesses.Partials.form_business_info')
                    @include('Admin.Businesses.Partials.form_business_address')
                    @include('Admin.Businesses.Partials.form_business_others')
                </form>


                <form action="{{ route('admin.businesses.delBankAccount',$business) }}" method="post" name="form_businesses_delBankAccount">
                    @csrf
                    @method('PUT')
                    @include('Admin.businesses.Partials.form_business_banks')
                </form>

                <div class="modal fade" id="modalSelectBankAccount">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h4 class="modal-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.BankAccount.BankAccounts') }}</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                @if ($bankAccounts->first())
                                        <table id="modal_bank_account_table" class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0"><small>id</small></th>
                                                <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                                                <th class="border-bottom-0"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bankAccounts as $bankAccount)
                                                <tr>
                                                    <td style="width: 60px;">{{ $bankAccount->id }}</td>
                                                    <td><span class="w-100 fw-bold">{{ $bankAccount->name }}</span></td>
                                                    <td class="text-right"  style="width: 30px;text-align: right;">
                                                        @can('businesses.edit')
                                                            <form action="{{ route('admin.businesses.addBankAccount',[$business,$bankAccount]) }}" method="post" name="form_modal_bank_acount">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-sm btn-green"><i class="fe fe-plus-circle fw-bold"></i></button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                @else
                                    <div class="col-12 text-center">
                                        <span>{{ trans('messages.BankAccount.NoBankAccount') }}</span>
                                        @can('bankAccounts.create')
                                            <h1><a href="{{ route('admin.bankAccounts.create') }}"><i class="fa-solid fa-circle-plus text-success"></i></a></h1>
                                        @endcan
                                    </div>

                                @endif
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light" data-bs-dismiss="modal">{{ trans('messages.Cancel') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
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
