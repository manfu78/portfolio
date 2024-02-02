@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Supplier.CreateSupplier') }} @endsection
@section('pagetitle') {{ trans('messages.Supplier.Supplier') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">{{ trans('messages.Supplier.Suppliers') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Supplier.CreateSupplier') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.suppliers.store') }}" method="post" name="form_supplier_store" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @include('Admin.Suppliers.Partials.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
