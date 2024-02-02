@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.PaymentMethod.CreatePaymentMethod') }} @endsection
@section('pagetitle') {{ trans('messages.PaymentMethod.PaymentMethod') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.paymentMethods.index') }}">{{ trans('messages.PaymentMethod.PaymentMethod') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.PaymentMethod.CreatePaymentMethod') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.paymentMethods.store') }}" method="post" name="form_payment_method_store">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-file-plus"></i></span>&nbsp;{{ trans('messages.Department.NewDepartment') }}
                        </div>
                        @include('Admin.PaymentMethods.Partials.form')
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
