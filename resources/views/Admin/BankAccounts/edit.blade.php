@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditBankAccount') }} @endsection
@section('pagetitle') {{ trans('messages.BankAccount.BankAccount') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.bankAccounts.index') }}">{{ trans('messages.BankAccount.BankAccounts') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.BankAccount.EditBankAccount') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.bankAccounts.update',$bankAccount) }}" method="post" name="form_bank_account_update">
                    @csrf
                    @method('PUT')
                    @include('Admin.BankAccounts.Partials.form_bank_dat')
                    @include('Admin.BankAccounts.Partials.form_bank_account')
                    @include('Admin.BankAccounts.Partials.form_bank_address')
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12 text-end">
                                    <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.bankAccounts.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
                                </div>
                            </div>
                        </div>
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
