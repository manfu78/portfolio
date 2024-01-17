
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col 12">
                    <div class="media d-flex">
                        @if (isset($userProfile)&&$userProfile->photo)
                            <span class="me-3">
                                <span class="avatar  brround cover-image" data-bs-image-src="{{ Storage::url($userProfile->photo) }}" onerror="this.src='/assets/images/profileimg.png'" style="width: 75px;height: 75px;object-fit: cover;">
                                </span>
                            </span>
                        @else
                            <span class="avatar avatar-xxl brround bg-default mx-4" style="width: 75px;height: 75px;object-fit: cover;">
                                {{ substr(auth()->user()->name,0,1) }}
                            </span>
                        @endif
                        <div class="media-body mt-2">
                            <div class="text-dark">
                                <h6>
                                    <small class="text-muted">{{ trans('messages.User.User') }}:</small>&nbsp;<span class="fw-bold fs-5">{{ $userProfile->user->name }}</span>
                                    <br>
                                    <small class="text-muted">Email&nbsp;{{ trans('messages.User.User') }}:</small>&nbsp;<span class="fw-bold fs-5">{{ $userProfile->user->email }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

