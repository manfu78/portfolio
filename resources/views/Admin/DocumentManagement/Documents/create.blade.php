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
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.Document.CreateDocument') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-10 col-xxl-10 mx-auto">
                {!! Form::open(array('route'=>'admin.documents.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
                @csrf
                    @include('Admin.DocumentManagement.Documents.Partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts_js')
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        var customer_id = $('#customer_id').val();
        var worker_id = $('#worker_id').val();

        $('#customer_id').change(function() {
            var customer_id = $(this).val();
            // console.log(customer_id);
            hideAll();
            $('#project_id').empty();
            $('#project_chore_id').empty();
            $('#opportunity_id').empty()

            document.getElementById('worker_id').value = '';
            document.getElementById('select2-worker_id-container').innerHTML = '{{ trans('messages.All') }}';
            document.getElementById('business_id').value = '';
            document.getElementById('select2-business_id-container').innerHTML = '{{ trans('messages.All') }}';

            if (customer_id != '') {
                document.getElementById('project_id_col').style.display = 'block';
                document.getElementById('opportunity_id_col').style.display = 'block';
                document.getElementById('customer_linked_at').checked = true;
                $.ajax({
                    url: '{{ route("admin.documents.customerProjects", ":customer_id") }}'.replace(':customer_id', customer_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        $('#project_id').append('<option value="">{{ trans('messages.SelectProject') }}</option>');

                        $.each(data, function(index, customerProjects) {
                            $('#project_id').append('<option value="'+ customerProjects.id +'">'+ customerProjects.name +'</option>');
                        });
                    }
                });
                $.ajax({
                    url: '{{ route("admin.documents.customerOpportunities", ":customer_id") }}'.replace(':customer_id', customer_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#opportunity_id').append('<option value="">{{ trans('messages.SelectOpportunity') }}</option>');
                        $.each(data, function(index, customerOpportunities) {
                            $('#opportunity_id').append('<option value="'+ customerOpportunities.id +'">'+ customerOpportunities.name +'</option>');
                        });
                    }
                });
            }
        });
        $('#project_id').change(function() {
            var project_id = $(this).val();
            document.getElementById('opportunity_id').value = '';
            document.getElementById('select2-opportunity_id-container').innerHTML = 'Todos';

            if (project_id != '') {
                document.getElementById('project_chore_id_col').style.display = 'block';
                document.getElementById('project_linked_at').checked = true;
                $.ajax({
                    url: '{{ route("admin.documents.projectProjectChores", ":project_id") }}'.replace(':project_id', project_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#project_chore_id').append('<option value="">{{ trans('messages.SelectProjectChore') }}</option>');

                        $.each(data, function(index, projectChores) {
                            $('#project_chore_id').append('<option value="'+ projectChores.id +'">'+ projectChores.name +'</option>');
                        });
                    }
                });

            }

        });
        $('#project_chore_id').change(function() {
            document.getElementById('opportunity_id').value = '';
            document.getElementById('select2-opportunity_id-container').innerHTML = '{{ trans('messages.SelectOpportunity') }}';
            if (project_chore_id != '') {
                document.getElementById('project_chore_linked_at').checked = true;
            }
        });
        $('#opportunity_id').change(function() {
            document.getElementById('project_id').value = '';
            document.getElementById('select2-project_id-container').innerHTML = '{{ trans('messages.SelectProject') }}';
            document.getElementById('project_chore_id').value = '';
            document.getElementById('select2-project_chore_id-container').innerHTML = '{{ trans('messages.SelectProjectChore') }}';
            if (opportunity_id != '') {
                document.getElementById('opportunity_linked_at').checked = true;
            }
        });

        $('#worker_id').change(function() {
            var worker_id = $(this).val();
            // console.log('{{ route("admin.documents.workerOpportunities", ":worker_id") }}'.replace(':worker_id', worker_id));
            hideAll();
            $('#project_id').empty();
            $('#project_chore_id').empty();
            $('#opportunity_id').empty()

            document.getElementById('customer_id').value = '';
            document.getElementById('select2-customer_id-container').innerHTML = '{{ trans('messages.All') }}';
            document.getElementById('business_id').value = '';
            document.getElementById('select2-business_id-container').innerHTML = '{{ trans('messages.All') }}';

            if (worker_id != '') {
                document.getElementById('opportunity_id_col').style.display = 'block';
                document.getElementById('worker_linked_at').checked = true;
                $.ajax({
                    url: '{{ route("admin.documents.workerOpportunities", ":worker_id") }}'.replace(':worker_id', worker_id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#opportunity_id').append('<option value="">{{ trans('messages.SelectOpportunity') }}</option>');
                        $.each(data, function(index, workerOpportunities) {
                            $('#opportunity_id').append('<option value="'+ workerOpportunities.id +'">'+ workerOpportunities.name +'</option>');
                        });
                    }
                });
            }
        });
        $('#business_id').change(function() {
            hideAll();
            $('#project_id').empty();
            $('#project_chore_id').empty();
            $('#opportunity_id').empty()
            document.getElementById('customer_id').value = '';
            document.getElementById('select2-customer_id-container').innerHTML = '{{ trans('messages.All') }}';
            document.getElementById('worker_id').value = '';
            document.getElementById('select2-worker_id-container').innerHTML = '{{ trans('messages.All') }}';
            if (business_id != '') {
                document.getElementById('business_linked_at').checked = true;
            }

        });
    });

</script>
<script>
    function hideAll() {
        document.getElementById('project_id_col').style.display = 'none';
        document.getElementById('project_chore_id_col').style.display = 'none';
        document.getElementById('opportunity_id_col').style.display = 'none';
    }

</script>

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
