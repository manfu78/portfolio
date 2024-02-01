<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-info-transparent p-2">
                <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.Information') }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Name') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->name }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.LastName') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->lastname }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">NIF</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->nif }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Phone') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->phone }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Email') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->email }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Business.Business') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->business->name }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.IsCommercial') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->is_commercial===0?'NO':__('Yes') }}&nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Category.Category') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->category->name }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
