@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditNotification') }} @endsection
@section('pagetitle') {{ trans('messages.Notification.Notification') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.notifications.index') }}">{{ trans('messages.Notification.Notifications') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Notification.EditNotification') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.notifications.update',$notification) }}" method="post" name="form_notifications_update" class="submit-prevent-form">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ trans('messages.Notification.EditNotification') }}
                        </div>
                        @include('Admin.Notifications.Partials.form')
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
