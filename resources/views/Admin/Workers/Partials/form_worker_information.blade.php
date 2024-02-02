<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-info-transparent p-2">
                <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.Information') }}
            </div>
            <div class="card-body">
                {{-- @if (isset($worker))
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
                @endif --}}
                @if (isset($worker))
                    <div class="row">
                        <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-8 col-xxl-8">
                            <div class="form-group">
                                <small>
                                    <span {{ ($errors)->has('status')?'class="text-danger"':'' }}> {{ trans('messages.Active') }}</span>
                                </small>
                                <div class="form-control-plaintext material-switch pull-right">
                                    <input type="checkbox"
                                        name="status" id="someSwitchOptionSuccess"
                                        class="custom-control-input"
                                        value="1" @if (isset($worker)) {{  $worker->status? 'checked':'' }} @else checked @endif>
                                    <label for="someSwitchOptionSuccess" class="label-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                        <div class="form-group">
                            <small>
                                <span {{ ($errors)->has('name')?'class="text-danger"':'' }}> {{ trans('messages.Name') }} </span>
                                <span class="text-red">*</span>
                            </small>
                            <input type="text"
                                name="name" id="name"
                                class="form-control {{ (($errors)->has('name')?'is-invalid':'') }}"
                                value="{{ isset($worker)?$worker->name:old('name') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                        <div class="form-group">
                            <small>
                                <span {{ ($errors)->has('lastname')?'class="text-danger"':'' }}> {{ trans('messages.Lastname') }} </span>
                                <span class="text-red">*</span>
                            </small>
                            <input type="text"
                                name="lastname" id="lastname"
                                class="form-control {{ (($errors)->has('lastname')?'is-invalid':'') }}"
                                value="{{ isset($worker)?$worker->lastname:old('lastname') }}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="form-group">
                            <small>
                                <span {{ ($errors)->has('nif')?'class="text-danger"':'' }}> NIF </span>
                                <span class="text-red">*</span>
                            </small>
                            <input type="text"
                                name="nif" id="nif"
                                class="form-control {{ (($errors)->has('nif')?'is-invalid':'') }}"
                                value="{{ isset($worker)?$worker->nif:old('nif') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="form-group">
                            <small>
                                <span {{ ($errors)->has('phone')?'class="text-danger"':'' }}> {{ trans('messages.Phone') }} </span>
                            </small>
                            <input type="text"
                                name="phone" id="phone"
                                class="form-control {{ (($errors)->has('phone')?'is-invalid':'') }}"
                                value="{{ isset($worker)?$worker->phone:old('phone') }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                        <div class="form-group">
                            <small>
                                <span {{ ($errors)->has('nif')?'class="text-danger"':'' }}> {{ trans('messages.Email') }} </span>
                                <span class="text-red">*</span>
                            </small>
                            <input type="email"
                                name="email" id="email"
                                class="form-control {{ (($errors)->has('email')?'is-invalid':'') }}"
                                value="{{ isset($worker)?$worker->email:old('email') }}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <small>
                            <span {{ ($errors)->has('nif')?'class="text-danger"':'' }}> {{ trans('messages.Business.Business') }} </span>
                            <span class="text-red">*</span>
                        </small>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="business_id" class="form-control select2 form-select {{ (($errors)->has('business_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Business.Business') }}">
                                        @foreach($businessSelect as $businessId => $businessName)
                                            <option value="{{ $businessId }}" @if (isset($worker)){{ $businessId == $worker->business_id ? 'selected' : '' }}@endif>
                                            {{ $businessName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <small>
                            <span {{ ($errors)->has('nif')?'class="text-danger"':'' }}> {{ trans('messages.Category.Category') }} </span>
                            <span class="text-red">*</span>
                        </small>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="category_id" class="form-control select2 form-select {{ (($errors)->has('category_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Category.Category') }}">
                                        @foreach($categorySelect as $categoryId => $categoryName)
                                            <option value="{{ $categoryId }}" @if (isset($worker)){{ $categoryId == $worker->category_id ? 'selected' : '' }}@endif>
                                            {{ $categoryName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <small>
                            <span {{ ($errors)->has('nif')?'class="text-danger"':'' }}> {{ trans('messages.Department.Department') }} </span>
                            <span class="text-red">*</span>
                        </small>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="department_id" class="form-control select2 form-select {{ (($errors)->has('department_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Category.Category') }}">
                                        @foreach($departmentSelect as $departmentId => $departmentName)
                                            <option value="{{ $departmentId }}" @if (isset($worker)){{ $departmentId == $worker->department_id ? 'selected' : '' }}@endif>
                                            {{ $departmentName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <small>
                            <span {{ ($errors)->has('nif')?'class="text-danger"':'' }}> {{ trans('messages.Area.Area') }} </span>
                            <span class="text-red">*</span>
                        </small>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="area_id" class="form-control select2 form-select {{ (($errors)->has('area_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Category.Category') }}">
                                        @foreach($areaSelect as $areaId => $areaName)
                                            <option value="{{ $areaId }}" @if (isset($worker)){{ $areaId == $worker->area_id ? 'selected' : '' }}@endif>
                                            {{ $areaName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="form-group m-0">
                            <div class="custom-controls-stacked">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                        name="is_commercial"
                                        class="custom-control-input"
                                        value="1" @if (isset($worker)) {{  $worker->is_commercial? 'checked':'' }} @endif>
                                    <span class="custom-control-label">{{ trans('messages.IsCommercial') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
