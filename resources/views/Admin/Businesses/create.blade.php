@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Business.CreateBusiness') }} @endsection
@section('pagetitle') {{ trans('messages.Business.Business') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title"><i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Business.CreateBusiness') }}</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.businesses.index') }}">{{ trans('messages.Business.Businesses') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Business.CreateBusiness') }}</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{ route('admin.businesses.store') }}" method="post" name="form_businesses_store" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @include('Admin.Businesses.Partials.form_business_logo')
                    @include('Admin.Businesses.Partials.form_business_info')
                    @include('Admin.Businesses.Partials.form_business_address')
                    @include('Admin.Businesses.Partials.form_business_others')
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12 text-end">
                                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.resources.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
                            </div>
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
<script>
    $(document).ready(function(){
        $('#logo').change(function(e){
            let file= e.target.files[0];
            let reader= new FileReader();
            reader.onload= (event) => {
                $('#business-img').attr('src', event.target.result)
            };
            reader.readAsDataURL(file);
        })
    });
</script>
@endsection
