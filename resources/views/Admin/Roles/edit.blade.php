@extends('layouts.admin.app')

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Role.EditRole') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.roles.update',$role) }}" method="POST" name="form_role_update" id="form_role_update">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ trans('messages.Role.EditRole') }}
                        </div>
                        @include('Admin.Roles.Partials.form')
                    </div>
                </form>
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
