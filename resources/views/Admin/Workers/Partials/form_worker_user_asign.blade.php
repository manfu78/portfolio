<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-info-transparent p-2">
                <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.User.User') }}
            </div>
            <div class="card-body">
                @if (isset($worker))
                    @if ($worker->user)
                        <div class="row">
                            <small>{{ trans('messages.User.User') }}&nbsp;{{ trans('messages.Assigned') }}</small>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control form-control-sm" value="{{ $worker->user->name }}" readonly>
                                @can('users.edit')
                                    <a class="input-group-text btn btn-sm btn-info-light d-grid"
                                        href="{{ route('admin.users.edit',$worker->user) }}"
                                        data-bs-placement="top"
                                        data-bs-toggle="tooltip"
                                        title="{{ trans('messages.User.EditUser') }}">
                                        <span><i class="fe fe-edit"></i></span>
                                    </a>
                                @endcan
                                <a href="{{ route('admin.workers.unsetUser',$worker) }}" class="input-group-text btn btn-sm btn-info-light shadow-none">
                                    <i class="fa-regular fa-rectangle-xmark"></i> &nbsp;{{ trans('messages.PutOff') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <small>{{ trans('messages.Assign') }}&nbsp;{{ trans('messages.User.User') }}</small>
                            <div class="input-group mb-4">
                                <input type="text" class="form-control form-control-sm" value="..." readonly>
                                @can('users.create')
                                    <a class="btn btn-sm btn-info-light d-grid"
                                        href="{{ route('admin.users.create') }}?worker_id={{ $worker->id }}">
                                        <i class="fe fe-plus-circle"></i> &nbsp;{{ trans('messages.New') }}
                                    </a>
                                @endcan
                                <a class="modal-effect btn btn-sm btn-info-light d-grid"
                                    data-bs-toggle="modal"
                                    href="#modalSelectUser">
                                    <i class="fe fe-search"></i> &nbsp;{{ trans('messages.Assign') }}
                                </a>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="row">
                        <small>{{ trans('messages.User.User') }}&nbsp;{{ trans('messages.Assigned') }} ---</small>
                        <div class="input-group mb-4">
                            @if ($userAsign)
                                <input type="hidden" name="user_id" id="user_id" value="{{ $userAsign->id }}">
                                <input type="text" id="user_name" class="form-control form-control-sm" value="{{ $userAsign->name }}" readonly>
                            @else
                                <input type="hidden" name="user_id" id="user_id" value="">
                                <input type="text" id="user_name" class="form-control form-control-sm" value="" readonly>
                            @endif
                            <a class="modal-effect btn btn-sm btn-info-light d-grid"
                                data-bs-toggle="modal"
                                href="#modalSelectUser">
                                <i class="fe fe-search"></i> &nbsp;{{ trans('messages.Assign') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
