@extends('layouts.common.app')


@section('main_container')

    <div class="main-container container-fluid">
        <div class="page-header m-2">
            <h1 class="page-title"></h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row" id="user-profile">
        <div class="col-lg-12">

            <div class="card card-primary">
                <div class="card-header bg-info-transparent p-2">
                    <h4 class="card-title">
                        <span class="card-title fw-bold"><i class="fe fe-user"></i>&nbsp;{{ trans('messages.User.User') }}</span>
                    </h4>
                </div>
                {!! Form::model(auth()->user(),['route'=>['admin.profile.update',auth()->user()],'method'=>'patch','name'=>'frm_profile_update','enctype'=>'multipart/form-data']) !!}
                @csrf
                    <div class="card-body">
                        <div class="wideget-user mb-2">
                            <div class="row">
                                <div class="media d-flex">
                                    @if ($user->photo)
                                        <span>
                                            {{-- <div class="avatar avatar-xl brround cover-image mx-4"
                                                data-bs-image-src="{{ Storage::url($user->photo) }}"
                                                style="background: url(&quot;{{ Storage::url($user->photo) }}&quot;) center center;">
                                            </div> --}}
                                            <div class="avatar avatar-xl brround cover-image mx-4"
                                                data-bs-image-src="{{ route('file',$user->photo) }}"
                                                style="background: url(&quot;{{ route('file',$user->photo) }}&quot;) center center;">
                                            </div>
                                            <p class="text-center text-danger mt-2">
                                                <a href="#">
                                                    <small class="text-danger">
                                                        <i class="fe fe-trash-2"></i>&nbsp;
                                                        {{ trans('messages.Delete') }}&nbsp;{{ trans('messages.Photo') }}
                                                    </small>
                                                </a>
                                            </p>
                                        </span>
                                    @else
                                        <span class="avatar avatar-xxl brround bg-default mx-4">
                                            @if ($user->userProfile)
                                                {{ substr($user->userProfile->name,0,1).substr($user->userProfile->lastname,0,1) }}
                                            @else
                                                {{ substr($user->name,0,1) }}
                                            @endif
                                        </span>
                                    @endif

                                    @if ($user->userProfile)
                                        <div class="media-body mt-2 mx-3">
                                            <div class="text-dark">
                                                <h3 class="h3 mb-2">
                                                    {{ $user->userProfile->full_name }}
                                                </h3>
                                                <h5 class="text-muted">{{ $user->email }}</h5>
                                            </div>
                                        </div>
                                    @else
                                        <div class="media-body mt-2">
                                            <div class="text-dark">
                                                <h3 class="h3 mb-2">
                                                    {{ $user->name }}
                                                </h3>
                                                <h5 class="text-muted">{{ $user->email }}</h5>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col 12">
                                    <div class="form-group">
                                        <small class="mx-1 mt-0">{{ trans('messages.ChangePhoto') }}</small>
                                        <input id='photo' name="photo" class="form-control" type="file" accept="image/png, image/jpeg, image/gif, image/jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="card-title">
                                    <span class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('Update') }}&nbsp;{{ trans('messages.Information') }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <small>
                                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Username') }}</span>
                                    </small>
                                    {!! Form::text('name', null, array(
                                    'class'=>'form-control '.(($errors)->has('name')?'is-invalid':''),
                                    'value'=>old('name'),
                                    'id'=>'name',
                                    'autocomplete'=>'name',
                                )) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <small>
                                        <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>{{ trans('messages.Email') }}</span>
                                    </small>
                                    {!! Form::email('email', null, array(
                                    'class'=>'form-control '.(($errors)->has('email')?'is-invalid':''),
                                    'value'=>old('email'),
                                    'id'=>'email',
                                    'autocomplete'=>'email',
                                )) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer py-2"> --}}
                        {{-- <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                            </div>
                        </div> --}}
                    {{-- </div> --}}
                {!! Form::close() !!}

                {!! Form::open(array('route'=>'password.update','method'=>'PUT','name'=>'frm_password_update')) !!}
                @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="card-title">
                                    <span class="card-title fw-bold"><i class="fa-solid fa-key"></i>&nbsp;{{ trans('Update') }}&nbsp;{{ trans('messages.Password') }}</span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <small>
                                        <span {{ $errors->updatePassword->get('current_password')?'class="text-danger"':'' }}>{{ trans('messages.CurrentPassword') }}</span>
                                    </small>
                                    {!! Form::password('current_password', array(
                                        'class'=>'form-control '.($errors->updatePassword->get('current_password')?'is-invalid':''),
                                        'id'=>'current_password',
                                        'autocomplete'=>'current_password',
                                        //required
                                    )) !!}
                                    @if ($errors->updatePassword->get('current_password'))
                                        @foreach ($errors->updatePassword->get('current_password') as $passError)
                                            <small class="text-danger">{{ $passError }}</small><br>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <small>
                                        <span {{ $errors->updatePassword->get('password')?'class="text-danger"':'' }}> {{ trans('messages.Password') }} </span>
                                    </small>
                                    {!! Form::password('password', array(
                                        'class'=>'form-control '.($errors->updatePassword->get('password')?'is-invalid':''),
                                        'id'=>'password',
                                        'autocomplete'=>'password',
                                        //required
                                    )) !!}
                                    @if ($errors->updatePassword->get('password'))
                                        @foreach ($errors->updatePassword->get('password') as $passError)
                                            <small class="text-danger">{{ $passError }}</small><br>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <small>
                                        <span {{ $errors->updatePassword->get('password_confirmation')?'class="text-danger"':'' }}>{{ trans('messages.ConfirmPassword') }}</span>
                                    </small>
                                    {!! Form::password('password_confirmation', array(
                                        'class'=>'form-control '.($errors->updatePassword->get('password_confirmation')?'is-invalid':''),
                                        'id'=>'password_confirmation',
                                        'autocomplete'=>'password_confirmation',
                                    )) !!}
                                    @if ($errors->updatePassword->get('password_confirmation'))
                                        @foreach ($errors->updatePassword->get('password_confirmation') as $passError)
                                            <small class="text-danger">{{ $passError }}</small><br>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer py-2"> --}}
                        {{-- <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                            </div>
                        </div> --}}
                    {{-- </div> --}}
                {!! Form::close() !!}

            </div>

        </div>
    </div>


@endsection


@section('pagetitle') {{ config('app.name') }} @endsection
@section('sectiontitle') {{ trans('messages.Tenant.CreateTenant') }} @endsection


@section('page_css') @endsection

@section('scripts_header') @endsection

@section('styles') @endsection

@section('scripts_js') @endsection

@section('scripts')
@endsection
