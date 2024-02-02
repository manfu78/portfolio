@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Vat.CreateVat') }} @endsection
@section('pagetitle') {{ trans('messages.Vat.Vat') }} @endsection

@section('page_css') @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.vats.index') }}">{{ trans('messages.Vat.Vats') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Vat.CreateVat') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.vats.store') }}" method="post" name="form_vat_store">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fa-regular fa-file"></i></span>&nbsp;{{ trans('messages.New') }}
                        </div>
                        @include('Admin.Vats.Partials.form')
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
