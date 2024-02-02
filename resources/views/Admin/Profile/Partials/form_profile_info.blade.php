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
                <h4 class="font-weight-semibold mb-1"><small class="text-muted"><i class="fa-solid fa-user"></i>:</small>&nbsp;{{ $user->name }}</h4>
                {{-- <span><small><i class="fa-solid fa-user"></i>:</small>&nbsp;{{ $user->name }}</span> --}}

                @if ($user->worker->email)
                    <p class="m-0">
                        <small class="text-muted"><i class="fa-solid fa-envelope"></i>:</small>&nbsp;<a href="mailto:{{$user->worker->email}}">{{$user->worker->email}}</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
