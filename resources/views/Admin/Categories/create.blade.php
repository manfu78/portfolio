@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Category.CreateCategory') }} @endsection
@section('pagetitle') {{ trans('messages.Category.Category') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ trans('messages.Category.Category') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Category.CreateCategory') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.categories.store') }}" method="post" name="form_categorie_store">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-file-plus"></i></span>&nbsp;{{ trans('messages.Category.NewCategory') }}
                        </div>
                        @include('Admin.Categories.Partials.form')
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
