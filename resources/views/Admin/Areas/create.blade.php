@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Area.CreateArea') }} @endsection
@section('pagetitle') {{ trans('messages.Area.Area') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.areas.index') }}">{{ trans('messages.Area.Area') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Area.CreateArea') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.areas.store') }}" method="post" name="form_area_store">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-file-plus"></i></span>&nbsp;{{ trans('messages.Area.NewArea') }}
                        </div>
                        @include('Admin.Areas.Partials.form')
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
