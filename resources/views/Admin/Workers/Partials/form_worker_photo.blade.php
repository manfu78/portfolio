<div class="card">
    @if (isset($worker)&&$worker->user)
        <div class="card-body pb-1">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="text-dark">
                        <h3 class="h3 mb-1">
                        {{ trans('messages.User.User') }}:&nbsp;{{ $worker->user->name }}
                        </h3>
                        <h5 class="text-muted m-0"><small>Email {{ trans('messages.User.User') }}: </small>&nbsp;{{ $worker->user->email }}</h5>
                    </div>
                    @can('users.edit')
                        <a href="{{ route('admin.users.edit',$worker->user) }}">
                            <small>
                                <i class="fa-solid fa-pen-to-square"></i>&nbsp;
                                {{ trans('messages.User.EditUser') }}
                            </small>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    @endif

    <div class="card-body">
        <div class="row">
            <div class="col 12">
                <div class="media d-flex">
                    @if (isset($worker)&&$worker->photo)
                        <span class="me-2">
                            <span class="avatar  brround cover-image" data-bs-image-src="{{ Storage::url($worker->photo) }}" onerror="this.src='/assets/images/profileimg.png'" style="width: 75px;height: 75px;object-fit: cover;">
                                <a href="{{ route('admin.workers.removePhoto',$worker) }}"><span class="badge rounded-pill avatar-icons bg-red"><i class="fa-solid fa-trash-can"></i></span></a>
                            </span>
                        </span>
                    @else
                        <span class="avatar avatar-xxl brround bg-default mx-4" style="width: 75px;height: 75px;object-fit: cover;">
                            {{ substr(auth()->user()->name,0,1) }}
                        </span>
                    @endif
                    <div class="media-body mt-2">
                        <div class="form-group">
                            <small class="mx-1 mt-0">{{ trans('messages.ChangePhoto') }}</small>
                            <input id='photo' name="photo" class="form-control" type="file" accept="image/png, image/jpeg, image/gif, image/jpg">
                            @if (($errors)->has('photo'))
                                <small class="text-danger">{!! $errors->first('photo') !!}</small><br>
                            @endif
                        </div>
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

