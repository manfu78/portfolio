<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-info-transparent p-2">
                <h3 class="card-title fw-bold"><i class="fe fe-map"></i>&nbsp;{{ trans('messages.Address') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Address') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->address }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">C.P.</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->postal_code }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.City') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->city }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Province') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->province }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Country.Country') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->country->name }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Latitude') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->latitude }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Longitude') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $userProfile->longitude }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
