@if (isset($user))
    @if ($user->worker)
        <div class="card">
            <div class="card-body">
                <div class="media d-flex">
                    @if ($user->worker->photo)
                        <span class="me-2">
                            <img id="photo" class="avatar brround cover-image" src="{{ Storage::url($user->worker->photo) }}" onerror="this.src='/assets/images/profileimg.png'" style="width: 75px;height: 75px;object-fit: cover;">
                        </span>
                    @else
                        <span class="avatar avatar-xxl brround bg-default mx-4">
                            {{ substr($user->worker->name,0,1).substr($user->worker->lastname,0,1) }}
                        </span>
                    @endif
                    <div class="media-body">
                        <h4 class="font-weight-semibold mb-1">{{ $user->worker->full_name }}</h4>
                        @if ($user->worker->phone)
                            <span><a href="Tel:{{ $user->worker->phone }}"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;{{ $user->worker->phone }}</a></span>
                        @endif
                        @if ($user->worker->email)
                            <p class="m-0">
                                <a href="mailto:{{$user->worker->email}}"><small><i class="fa-solid fa-envelope"></i>:</small>&nbsp;{{$user->worker->email}}</a>
                            </p>
                        @endif
                        @can('workers.edit')
                            <a href="{{ route('admin.workers.edit',$user->worker) }}">
                                <small>
                                    <i class="fa-solid fa-pen-to-square"></i>&nbsp;
                                    {{ trans('messages.Worker.EditWorker') }}
                                </small>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ isset($user)?trans('messages.User.EditUser'):trans('messages.User.NewUser') }}
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                <h4 class="card-title">
                    <span class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('messages.Information') }}</span>
                </h4>
            </div>
        </div>
        @if (isset($user))
            @if ($user->worker)
                <div class="row">
                    <small>{{ trans('messages.Worker.Worker') }}&nbsp;{{ trans('messages.Assigned') }}</small>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" value="{{ $user->worker->full_name }}" readonly>
                        <a href="{{ route('admin.workers.unsetUser',$user->worker->id) }}?user=true" class="input-group-text btn btn-info-light shadow-none">
                            <i class="fe fe-save"></i> &nbsp;{{ trans('messages.PutOff') }}
                        </a>
                    </div>
                </div>
            @else
                <div class="row">
                    <small>{{ trans('messages.Worker.Worker') }}&nbsp;{{ trans('messages.Assigned') }}</small>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" value="..." readonly>
                        @can('workers.create')
                            <a class="btn btn-info-light d-grid"
                                href="{{ route('admin.workers.create') }}?user_id={{ $user->id }}">
                                <i class="fe fe-plus-circle"></i> &nbsp;{{ trans('messages.New') }}
                            </a>
                        @endcan
                        <a class="modal-effect btn btn-info-light d-grid"
                            data-bs-toggle="modal"
                            href="#modalSelectWorker">
                            <i class="fe fe-search"></i> &nbsp;{{ trans('messages.Assign') }}
                        </a>
                    </div>
                </div>
            @endif

        @endif
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Username') }}</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="name" id="name"
                        class="form-control {{ (($errors)->has('name')?'is-invalid':'') }}"
                        value="{{ isset($user)?$user->name:old('name') }}"
                        autocomplete="'name"
                        required>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>Email</span>
                        @if (request()->routeIs('admin.users.create')) <span class="text-red">*</span>@endif
                    </small>
                    <input type="email" name="email" id="email"
                        class="form-control {{ (($errors)->has('email')?'is-invalid':'') }}"
                        value="{{ isset($user)?$user->email:old('email') }}"
                        autocomplete="'email"
                        required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('password')?'class="text-danger"':'' }}> Password </span>
                        @if (request()->routeIs('admin.users.create')) <span class="text-red">*</span> @endif
                    </small>
                    <input type="password" name="password" id="password"
                        class="form-control {{ (($errors)->has('password')?'is-invalid':'') }}"
                        autocomplete="password"
                        {{ isset($user)?'':'required' }}>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <span {{ ($errors)->has('password')?'class="text-danger"':'' }}>{{ trans('messages.ConfirmPassword') }}</span>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control {{ (($errors)->has('password')?'is-invalid':'') }}"
                        autocomplete="password_confirmation"
                        {{ isset($user)?'':'required' }}>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-3">
            <div class="col-12">
                <h4 class="card-title mb-3">
                    <span class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('messages.Role.Roles') }}</span>
                </h4>
                <div class="example p-2">
                    <div class="form-group m-0">
                        <div class="custom-controls-stacked">
                            @foreach($roles as $role)
                                <label class="custom-control custom-checkbox-md">

                                    <input type="checkbox" name="roles[]" class="custom-control-input" value="{{ $role->id }}" {{ isset($user)&&$user->roles->contains($role->id)?'checked':'' }}>
                                    <span class="custom-control-label">{{$role->name}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.users.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
            </div>
        </div>
    </div>
</div>

