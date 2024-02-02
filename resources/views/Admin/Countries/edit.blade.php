@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditCountry') }} @endsection
@section('pagetitle') {{ trans('messages.Country.Country') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.countries.index') }}">{{ trans('messages.Country.Countries') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Country.EditCountry') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.countries.update',$country) }}" method="post" name="form_country_update">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ trans('messages.Country.EditCountry') }}
                        </div>
                        @include('Admin.Countries.Partials.form')
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
