@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.EditDocumentType') }} @endsection
@section('pagetitle') {{ trans('messages.DocumentType.DocumentType') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="row">
            <div class="col-xl-10 col-xxl-8 mx-auto">
                <div class="page-header">
                    <h1 class="page-title">&nbsp;</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.documentTypes.index') }}">{{ trans('messages.DocumentType.DocumentTypes') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.DocumentType.EditDocumentType') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-xl-10 col-xxl-8 mx-auto">
                <form action="{{ route('admin.documentTypes.update',$documentType) }}" method="post" name="form_document_type_update">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <i class="fe fe-edit fw-bold"></i>&nbsp;{{ trans('messages.DocumentType.EditDocumentType') }}
                        </div>
                        @include('Admin.DocumentManagement.DocumentTypes.Partials.form')
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
@endsection
