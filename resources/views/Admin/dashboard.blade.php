@extends('layouts.admin.app')

@section('main_container')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                {{-- <div class="card">
                    <div class="card-header bg-info-transparent p-2">Inquilino</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('sectiontitle') Descktop @endsection

@section('page_css') @endsection

@section('scripts_js')
@endsection

@section('scripts')
@endsection
