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
        @include('Admin.DocumentManagement.Documents.Partials.menu')
        <div class="row ">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-info-transparent p-2">
                        <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.MassiveUpload') }}
                    </div>

                    <div class="card-body">
                        <div class="panel panel-primary">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <li><a href="#tab-for-user" class="active" data-bs-toggle="tab">Por {{ trans('messages.User.User') }}</a></li>
                                        <li><a href="#tab-all-users" data-bs-toggle="tab">Para todos los {{ trans('messages.User.Users') }}</a></li>
                                        <li><a href="#tab-business" data-bs-toggle="tab">{{ trans('messages.Business.Business') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-for-user">
                                        @if ($workers->isNotEmpty())
                                            <form action="{{ route('admin.documents.massiveUploadStoreWorker') }}" method="post" name="form_document_up_user" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                @include('Admin.DocumentManagement.Documents.Partials.form_masive_uploads')
                                                <div class="row mt-4">
                                                    @foreach ($workers as $worker)
                                                        <div class="col-12 col-sm-6">
                                                            <div class="example mb-2 p-1">
                                                                <div class="media d-flex">
                                                                    @if ($worker->photo)
                                                                        <span class="me-2 mt-1">
                                                                            <span class="avatar brround cover-image" data-bs-image-src="{{ Storage::url($worker->photo) }}" onerror="this.src='/assets/images/profileimg.png'" style="width: 60px;height: 60px;object-fit: cover;"></span>
                                                                        </span>
                                                                    @else
                                                                        <span class="me-2 mt-1">
                                                                            <span class="avatar brround cover-image" data-bs-image-src="/assets/images/profileimg.png" style="width: 60px;height: 60px;object-fit: cover;"></span>
                                                                        </span>
                                                                    @endif
                                                                    <div class="media-body mx-2">
                                                                        <div>
                                                                            <span>{{ $worker->full_name }}&nbsp;</span>
                                                                            <br>
                                                                            <small>{{ $worker->email }}&nbsp;</small>
                                                                            <br>
                                                                            <small>{{ $worker->phone }}&nbsp;</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <input type="file" name="file_{{ $worker->id }}" class="dropify" onchange="readURL(this);" data-height="60" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col text-end">
                                                        <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.documents.index') }}"><span class="fa fa-close"></span>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><span class="fa fa-upload"></span>&nbsp;&nbsp;{{ trans('messages.Upload') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="row">
                                                <div class="col text-center">
                                                    {{ trans('messages.Worker.NoWorkers') }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane" id="tab-all-users">
                                        @if ($workers->isNotEmpty())
                                            <form action="{{ route('admin.documents.massiveUploadStoreWorkers') }}" method="post" name="form_document_up_all_users" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                @include('Admin.DocumentManagement.Documents.Partials.form_masive_uploads')
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group mb-0">
                                                            <input type="file" name="worker_file" class="dropify" onchange="readURL(this);" data-height="60" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="table-responsive">
                                                            <table class="table text-nowrap text-md-nowrap mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th><small>ID</small></th>
                                                                        <th><small>{{ trans('messages.Name') }}</small></th>
                                                                        <th><small>Email</small></th>
                                                                        <th><small>{{ trans('messages.Phone') }}</small></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($workers as $worker)
                                                                    <tr>
                                                                        <td class="py-1">
                                                                            <span class="avatar avatar-sm brround cover-image" data-bs-image-src="{{ Storage::url($worker->photo) }}" onerror="this.src='/assets/images/profileimg.png'" ></span>
                                                                        </td>
                                                                        <td class="py-1">
                                                                            <small>#{{ $worker->id }}</small>
                                                                        </td>
                                                                        <td class="py-1">
                                                                            <span class="fw-bold">{{ $worker->full_name }}</span>
                                                                        </td>
                                                                        <td class="py-1">
                                                                            <span>{{ $worker->email }}</span>
                                                                        </td>
                                                                        <td class="py-1">
                                                                            <span>{{ $worker->phone }}</span>
                                                                        </td>
                                                                        <td class="py-1 text-end">
                                                                            <div class="pt-1">
                                                                                <input type="checkbox" name="workers[]" value="{{ $worker->id }}" checked>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col text-end">
                                                        <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.documents.index') }}"><span class="fa fa-close"></span>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><span class="fa fa-upload"></span>&nbsp;&nbsp;{{ trans('messages.Upload') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="row">
                                                <div class="col text-center">
                                                    {{ trans('messages.Worker.NoWorkers') }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane" id="tab-business">
                                        @if ($business)
                                            <form action="{{ route('admin.documents.massiveUploadStoreBusiness') }}" method="post" name="form_document_up_business" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="example mb-2 p-1">
                                                        <div class="media d-flex">
                                                            @if ($business->logo && Storage::exists($business->logo))
                                                                <span class="me-2 mt-1">
                                                                    <span class="avatar brround cover-image" data-bs-image-src="{{ Storage::url($business->logo) }}" onerror="this.src='/assets/images/nophoto.jpeg'" style="width: 60px;height: 60px;object-fit: cover;"></span>
                                                                </span>
                                                            @else
                                                                <span class="me-2 mt-1">
                                                                    <span class="avatar brround cover-image" data-bs-image-src="/assets/images/nophoto.jpeg" style="width: 60px;height: 60px;object-fit: cover;"></span>
                                                                </span>
                                                            @endif
                                                            <div class="media-body mx-2">
                                                                <div>
                                                                    <span>{{ $business->name }}&nbsp;</span>
                                                                    <br>
                                                                    <small>{{ $business->email }}&nbsp;</small>
                                                                    <br>
                                                                    <small>{{ $business->phone }}&nbsp;</small>
                                                                    <input type="hidden" name="business_id" value="{{ $business->id }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @include('Admin.DocumentManagement.Documents.Partials.form_masive_uploads')
                                                <div class="row mt-3">
                                                    <div class="col p-0">
                                                        <input class="form-control" type="file" name="business_files[]" id="formFileMultiple" multiple>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col text-end">
                                                        <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.documents.index') }}"><span class="fa fa-close"></span>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
                                                        <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><span class="fa fa-upload"></span>&nbsp;&nbsp;{{ trans('messages.Upload') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="row">
                                                <div class="col text-center">
                                                    {{ trans('messages.Business.NoBusinessDefault') }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="/assets/plugins/fileuploads/js/fileupload.js"></script>
    {{-- <script src="/assets/plugins/fileuploads/js/file-upload.js"></script> --}}

    {{-- <input id="upload-users" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple> --}}

@endsection

@section('scripts')

<script>

    $('.dropify').dropify({
        messages: {
            'default': '',
            'replace': '',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        }
    });
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
