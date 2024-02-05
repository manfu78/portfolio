@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Notification.CreateNotification') }} @endsection
@section('pagetitle') {{ trans('messages.Notification.Notification') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.notifications.index') }}">{{ trans('messages.Notification.Notification') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Notification.CreateNotification') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.notifications.store') }}" method="post" name="form_notifications_store">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-file-plus"></i></span>&nbsp;{{ trans('messages.Notification.NewNotification') }}
                        </div>
                        @include('Admin.Notifications.Partials.form')
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
    <script>
        $(function(e) {
            "use strict";
            // Worker
            $('.worker').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.worker-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%'
            });
            $('.worker').on('click', () => {
                let selectField = document.querySelectorAll('.select2-search__field')
                selectField.focus();
                selectField.forEach((element, index) => {
                    element.focus();
                })
            });
        });
    </script>
@endsection
