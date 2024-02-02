@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditWorker') }} @endsection
@section('pagetitle') {{ trans('messages.Worker.Worker') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.profile.show') }}">{{ trans('messages.Profile') }}</a></li>
                </ol>
            </div>
        </div>

        @include('Admin.Profile.Partials.menu')
        @if ($user->worker)
            @include('Admin.Profile.Partials.form_profile_info')
        @endif
        @if (!$worker)
            <div class="row mb-4">
                <div class="col">
                    <div class="alert alert-danger mb-0 text-center" role="alert">
                        <span class="alert-inner--icon"><i class="fa-solid fa-circle-exclamation"></i></span>
                        <span class="alert-inner--text">{{ trans('messages.InfoWarning.FillInYourDetails') }}</span>
                    </div>
                </div>
            </div>
        @endif
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                @include('Admin.Workers.Partials.form_worker_information')
                @include('Admin.Workers.Partials.form_worker_address')
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-center">
                            <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.profile.show') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
