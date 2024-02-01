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

        <div class="row " id="edit_worker">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                @if ($worker)
                    @include('Admin.Profile.Partials.form_profile_photo')
                    @include('Admin.Profile.Partials.form_profile_information')
                    @include('Admin.Profile.Partials.form_profile_address')
                    @include('Admin.Profile.Partials.form_profile_others')
                @endif
            </div>
        </div>

    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
