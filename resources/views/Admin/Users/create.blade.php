@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.User.CreateUser') }} @endsection
@section('pagetitle') {{ trans('messages.User.User') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ trans('messages.User.Users') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.User.CreateUser') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.users.store') }}" method="post" name="form_users_store">
                    @csrf
                    @method('POST')
                    @include('Admin.Users.Partials.form')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
