@extends('layouts.admin.app')
@section('sectiontitle') {{ trans('messages.Document.CreateDocument') }} @endsection
@section('pagetitle') {{ trans('messages.Document.Document') }} @endsection

@section('main_container')
    <div class="main-container container-fluid">
        <div class="row">
            <div class="col-xl-10 col-xxl-10 mx-auto">
                <div class="page-header">
                    <h1 class="page-title">&nbsp;</h1>
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.documents.index') }}">{{ trans('messages.Document.Documents') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Document.EditDocument') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-10 col-xxl-10 mx-auto">
                {!! Form::model($document,['route'=>['admin.documents.update',$document],'method'=>'put','name'=>'form_document','enctype'=>'multipart/form-data']) !!}
                @csrf
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Document.EditDocument') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                                <div class="form-group m-0">
                                    <small>{{ trans('messages.Date') }}</small>
                                    {!! Form::date('date',null,[
                                        'class'=>'form-control ',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <small>
                                    <span {{ ($errors)->has('document_type_id')?'class="text-danger"':'' }}> {{ trans('messages.DocumentType.DocumentType') }} </span>
                                </small>
                                <div class="form-group">
                                    {!! Form::select('document_type_id', $documentTypeSelect,null,[
                                        'class'=>'form-control select2-show-search form-select',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <small>
                                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                                    </small>
                                    {!! Form::text('name', null, array(
                                    'class'=>'form-control '.(($errors)->has('name')?'is-invalid':''),
                                    'value'=>old('name'),
                                    'id'=>'name',
                                    'autocomplete'=>'name',
                                    'maxlength'=>191,
                                    'required'
                                )) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <small>
                                        <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Description') }}</span>
                                    </small>
                                    {!! Form::text('description', null, [
                                        'class'=>'form-control '.(($errors)->has('description')?'is-invalid':''),
                                        'value'=>old('description'),
                                        'maxlength'=>500,
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        {{-- TAGS --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-1">
                                    <small>
                                        <span {{ ($errors)->has('tags')?'class="text-danger"':'' }}> {{ trans('messages.Tags') }}&nbsp;({{ trans('messages.SeparateByCommas') }})</span>
                                    </small>
                                    <div class="form-control">
                                        {!! Form::text('tags', $tags, [
                                            'data-role'=>'tagsinput',
                                            'style'=>'width:100%;',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-12 col-sm-4">
                                <small>
                                    <span {{ ($errors)->has('document_type_id')?'class="text-danger"':'' }}> {{ trans('messages.DocumentType.DocumentType') }} </span>
                                </small>
                                <div class="form-group">
                                    {!! Form::select('document_type_id', $documentTypeSelect,null,[
                                        'class'=>'form-control select2-show-search form-select',
                                        'required'
                                    ]) !!}
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <div class="mb-0 mt-4 row justify-content-end">
                            <div class="col text-end">
                                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.documents.index') }}"><i class="fa fa-close"></i>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
                                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('page_css')
    <link rel="stylesheet" href="/assets/plugins/tags-inputs/bootstrap-tagsinput.css">
@endsection

@section('scripts_js')
    {{-- tags-inputs --}}
    <script src="/assets/plugins/tags-inputs/bootstrap-tagsinput.min.js"></script>
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

        // Lindedmodel
        $('.linkedmodel').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('.linkedmodel-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.linkedmodel').on('click', () => {
            let selectField = document.querySelectorAll('.select2-search__field')
            selectField.focus();
            selectField.forEach((element, index) => {
                element.focus();
            })
        });

        // Project
        $('.project').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('.project-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.project').on('click', () => {
            let selectField = document.querySelectorAll('.select2-search__field')
            selectField.focus();
            selectField.forEach((element, index) => {
                element.focus();
            })
        });

        // ProjectChore
        $('.projectChore').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('.projectChore-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.projectChore').on('click', () => {
            let selectField = document.querySelectorAll('.select2-search__field')
            selectField.focus();
            selectField.forEach((element, index) => {
                element.focus();
            })
        });

        // Customer
        $('.customer').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('.customer-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.customer').on('click', () => {
            let field = document.getElementsByClassName('customer')
            field.focus();
            let selectField = document.querySelectorAll('select2-search__field')
            selectField.forEach((element, index) => {
                element.focus();
            })
        });

        // Business
        $('.business').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('.business-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.business').on('click', () => {
            let selectField = document.querySelectorAll('.select2-search__field')
            selectField.focus();
            selectField.forEach((element, index) => {
                element.z
                element.focus();
            })
        });

        // OPPORTUNITY
        $('.opportunity').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('.opportunity-show-search').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('.opportunity').on('click', () => {
            let selectField = document.querySelectorAll('.select2-search__field')
            selectField.focus();
            selectField.forEach((element, index) => {
                element.focus();
            })

        });

    });
</script>

@endsection
