@extends('layouts.admin.app')

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fe fe-edit"></i>&nbsp;{{ trans('messages.Role.EditRole') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Role.EditRole') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                {!! Form::model($role,['route'=>['admin.roles.update',$role],'method'=>'put']) !!}
                @csrf
                    @include('Admin.Roles.Partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('sectiontitle') {{ trans('messages.Role.EditRole') }} @endsection
@section('page_css') @endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
