@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditCategory') }} @endsection
@section('pagetitle') {{ trans('messages.Category.Category') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fe fe-edit"></i>&nbsp;{{ trans('messages.Category.EditCategory') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ trans('messages.Category.Categories') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Category.EditCategory') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.categories.update',$category) }}" method="post" name="form_category_update" class="submit-prevent-form">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.Category.EditCategory') }}
                        </div>
                        @include('Admin.Categories.Partials.form')
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
