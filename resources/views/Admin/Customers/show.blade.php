@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Customer.ShowCustomer') }} @endsection
@section('pagetitle') {{ trans('messages.Customer.Customer') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fa-solid fa-user-tie"></i>&nbsp;{{ trans('messages.Customer.Customer') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">{{ trans('messages.Customer.Customers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Customer.ViewCustomer') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h3 class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('messages.Information') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm">
                                <div class="form-group">
                                    <small>
                                        <span class="tag tag-success"> {{ trans('messages.Active') }}</span>
                                    </small>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <small>ID</small>
                                    <div class="form-control text-end">
                                        {{ $customer->id }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <small>NCC</small>
                                    <div class="form-control">
                                        {{ $customer->ncc }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>{{ trans('messages.Name') }}</small>
                                    <div class="form-control">
                                        {{ $customer->name }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Tradename') }}</small>
                                        <div class="form-control">
                                            {{ $customer->tradename }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>CIF/NIF</small>
                                        <div class="form-control">
                                            {{ $customer->cif }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Phone') }}</small>
                                        <div class="form-control">
                                            {{ $customer->phone }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Email') }}</small>
                                        <div class="form-control">
                                            {{ $customer->email }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h3 class="card-title fw-bold"><i class="fe fe-users"></i>&nbsp;{{ trans('messages.Contact.Contacts') }}</h3>
                    </div>
                    <div class="card-body">
                        @if ($customer->customerContacts->count()>0)
                            <div class="row mb-3">
                                <div class="col-12 table-responsive">
                                    <table id="bank_account_table" class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="border-bottom-0"><small>id</small></th>
                                            <th class="border-bottom-0"><small>{{ trans('messages.Contact.Contact') }}</small></th>
                                            <th class="border-bottom-0"><small>{{ trans('messages.Phone') }}</small></th>
                                            <th class="border-bottom-0"><small>{{ trans('messages.Email') }}</small></th>
                                            <th class="border-bottom-0"><small>{{ trans('messages.Position') }}</small></th>
                                            <th class="border-bottom-0"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer->customerContacts as $contact)
                                            <tr>
                                                <td>{{ $contact->id }}</td>
                                                <td>{{ $contact->contact }}</td>
                                                <td>{{ $contact->phone }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->position }}</td>
                                                <td class="text-right">
                                                    @can('customers.edit')
                                                        <a class="modal-effect btn text-danger btn-sm py-0"
                                                            data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                            data-name="{{ $contact->contact }}"
                                                            data-route="{{ route('admin.customers.deleteContact',$contact->id) }}">
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
                        @else
                            <div class="row mb-4"><div class="col text-center">{{ trans('messages.Info.NoRecordsFound') }}</div></div>
                        @endif
                        @can('customers.edit')
                            <div class="row">
                                <div class="col-12 text-center">
                                    <a class="modal-effect btn btn-info-light"
                                        data-bs-toggle="modal"
                                        href="#modalSelectCustomerContact">
                                        <i class="fe fe-plus-circle"></i> &nbsp;{{ trans('messages.Contact.CreateContact') }}
                                    </a>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h3 class="card-title fw-bold"><i class="fe fe-map"></i>&nbsp;{{ trans('messages.Address') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Address') }}</small>
                                        <div class="form-control">
                                            {{ $customer->address }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>C.P.</small>
                                        <div class="form-control">
                                            {{ $customer->postal_code }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.City') }}</small>
                                        <div class="form-control">
                                            {{ $customer->city }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Province') }}</small>
                                        <div class="form-control">
                                            {{ $customer->province }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Country.Country') }}</small>
                                        <div class="form-control">
                                            {{ $customer->country?$customer->country->name:'' }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Latitude') }}</small>
                                        <div class="form-control">
                                            {{ $customer->latitude }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <small>{{ trans('messages.Longitude') }}</small>
                                        <div class="form-control">
                                            {{ $customer->longitude }}&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h3 class="card-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.AccountNumber') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>BIC/SWIFT</small>
                                    <div class="form-control">
                                        {{ $customer->bic }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <div class="form-group">
                                    <small>IBAN</small>
                                    <div class="form-control">
                                        {{ $customer->iban }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h3 class="card-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.Billing') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                <div class="form-group">
                                    <small>{{ trans('messages.Vat.Vat') }}</small>
                                        <div class="form-control">
                                            {{ $customer->vat?$customer->vat->description:'' }}&nbsp;
                                        </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                                <div class="form-group">
                                    <small>{{ trans('messages.ComercialDiscount') }}</small>
                                    <div class="form-control">
                                        {{ $customer->comercial_discount.' %' }}&nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                                <div class="form-group">
                                    <small>{{ trans('messages.ProntPaymentDiscount') }}</small>
                                    <div class="form-control">
                                        {{ $customer->pront_payment_discount.' %' }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <h3 class="card-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.OtherData') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <small>{{ trans('messages.Observations') }}</small>
                                    <div class="form-control">
                                        {{ $customer->observations }}&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('Admin.Customers.Partials.documents')

                @if ($customer->expenses->count()>0)
                    @include('Admin.Customers.Partials.expenses')
                @endif

                {{-- Modal para añadir fichero --}}
                <div class="modal fade" id="modalAddFile">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header bg-primary-transparent py-1">
                                <h5 class="modal-title fw-bold"><i class="fa-solid fa-door-open"></i>&nbsp;{{ trans('messages.Document.Document') }}</h5>
                                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            {!! Form::open(array('route'=>['admin.customers.addDocument',$customer],'method'=>'POST','name'=>'form_add_document','enctype'=>'multipart/form-data')) !!}
                            @csrf
                                <input type="hidden" name="ubi" value="{{ base64_encode('admin.customers.edit') }}">
                                <div class="modal-body">
                                    @include('Admin.DocumentManagement.Documents.Partials.form-documents')
                                </div>
                                <div class="modal-footer py-1">
                                    <button class="btn btn-sm ripple btn-outline-success" type="submit">
                                        <i class="fa fa-save"></i>&nbsp;{{ trans('messages.Save') }}
                                    </button>
                                    <button class="btn btn-sm ripple btn-outline-default" data-bs-dismiss="modal" type="button">
                                        <i class="fa fa-close"></i>&nbsp;{{ trans('messages.Cancel') }}
                                    </button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                {{-- MODAL Contactos --}}
                {!! Form::model($customer,['route'=>['admin.customers.addContact',$customer->id],'name'=>'form_modal_contact','method'=>'put']) !!}
                @csrf
                    <div class="modal fade" id="modalSelectCustomerContact">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h4 class="modal-title fw-bold"><i class="fe fe-user-plus"></i>&nbsp;{{ trans('messages.Contact.NewContact') }}</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('contact')?'class="text-danger"':'' }}>{{ trans('messages.Contact.Contact') }}</span>
                                                    <span class="text-red">*</span>
                                                </small>
                                                {!! Form::text('contact', '', [
                                                    'class'=>'form-control '.(($errors)->has('contact')?'is-invalid':''),
                                                    'value'=>old('contact'),
                                                    'placeholder'=>'...',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('phone')?'class="text-danger"':'' }}>{{ trans('messages.Phone') }}</span>
                                                </small>
                                                {!! Form::text('phone', '', [
                                                    'class'=>'form-control '.(($errors)->has('phone')?'is-invalid':''),
                                                    'value'=>old('phone'),
                                                    'placeholder'=>'...',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>{{ trans('messages.Email') }}</span>
                                                </small>
                                                {!! Form::email('email', '', [
                                                    'class'=>'form-control '.(($errors)->has('email')?'is-invalid':''),
                                                    'value'=>old('email'),
                                                    'placeholder'=>'...',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('position')?'class="text-danger"':'' }}>{{ trans('messages.Position') }}</span>
                                                </small>
                                                {!! Form::text('position', '', [
                                                    'class'=>'form-control '.(($errors)->has('position')?'is-invalid':''),
                                                    'value'=>old('position'),
                                                    'placeholder'=>'...',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-sm btn-outline-success"><i class="fe fe-user-plus fw-bold"></i>&nbsp;{{ trans('messages.Contact.CreateContact') }}</button>
                                    <button class="btn btn-sm btn-outline-default" data-bs-dismiss="modal"><i class="fe fe-x-square"></i>&nbsp;{{ trans('messages.Cancel') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @can('customers.edit')
    @include('layouts.admin.modal.delete-reg-html')
@endcan
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    @can('customers.edit')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
