@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Customer.EditCustomer') }} @endsection
@section('pagetitle') {{ trans('messages.Customer.Customer') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">{{ trans('messages.Customer.Customers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Customer.EditCustomer') }}</li>
                </ol>
            </div>
        </div>
        @include('Admin.Customers.Partials.menu')
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.customers.update',$customer->id) }}" method="post" name="form_customer" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('Admin.Customers.Partials.form')
                </form>

                {{-- MODAL Contactos --}}
                <form action="{{ route('admin.customers.addContact',$customer->id) }}" method="post" name="form_modal_contact">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="modalSelectCustomerContact">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <span class="fw-bold"><i class="fe fe-user-plus"></i></span>&nbsp;{{ trans('messages.Contact.NewContact') }}<button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('contact')?'class="text-danger"':'' }}>{{ trans('messages.Contact.Contact') }}</span>
                                                    <span class="text-red">*</span>
                                                </small>
                                                <input type="text" name="contact"
                                                    class="form-control  {{ (($errors)->has('contact')?'is-invalid':'') }}"
                                                    autocomplete="contact"
                                                    maxlength="255"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('phone')?'class="text-danger"':'' }}>{{ trans('messages.Phone') }}</span>
                                                </small>
                                                <input type="text" name="phone"
                                                    class="form-control  {{ (($errors)->has('phone')?'is-invalid':'') }}"
                                                    autocomplete="phone"
                                                    maxlength="255"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>{{ trans('messages.Email') }}</span>
                                                </small>
                                                <input type="text" name="email"
                                                    class="form-control  {{ (($errors)->has('email')?'is-invalid':'') }}"
                                                    autocomplete="email"
                                                    maxlength="255"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small>
                                                    <span {{ ($errors)->has('position')?'class="text-danger"':'' }}>{{ trans('messages.Position') }}</span>
                                                </small>
                                                <input type="text" name="position"
                                                    class="form-control  {{ (($errors)->has('position')?'is-invalid':'') }}"
                                                    autocomplete="position"
                                                    maxlength="255"
                                                    required>
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
                </form>
            </div>
        </div>
    </div>
    @can('customers.destroy')
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
