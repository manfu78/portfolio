@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditCoinType') }} @endsection
@section('pagetitle') {{ trans('messages.CoinType.CoinType') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fe fe-edit"></i>&nbsp;{{ trans('messages.CoinType.EditCoinType') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.coinTypes.index') }}">{{ trans('messages.CoinType.CoinTypes') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.CoinType.EditCoinType') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.coinTypes.update',$coinType) }}" method="post" name="form_coin_type_update">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ trans('messages.CoinType.EditCoinType') }}
                        </div>
                        @include('Admin.CoinTypes.Partials.form')
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
