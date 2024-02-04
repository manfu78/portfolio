@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditDepartment') }} @endsection
@section('pagetitle') {{ trans('messages.Department.Department') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">{{ trans('messages.Department.Departments') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Department.EditDepartment') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.departments.update',$department) }}" method="post" name="form_event_update" class="submit-prevent-form">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ trans('messages.Department.EditDepartment') }}
                        </div>
                        @include('Admin.Departments.Partials.form')
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
@endsection
