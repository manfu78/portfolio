@extends('layouts.admin.app')

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Role.NewRole') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Role.CreateRole') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                {!! Form::open(array('route'=>'admin.roles.store','method'=>'POST')) !!}
                @csrf
                    @include('Admin.Roles.Partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('sectiontitle') {{ trans('messages.Role.CreateRole') }} @endsection
@section('page_css') @endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
