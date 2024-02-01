<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header bg-info-transparent p-2">
                <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.OtherData') }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <small>
                                <span class="text-muted">{{ trans('messages.Observations') }}</span>
                            </small>
                            <div class="form-control" style="border-top: 0;border-right: 0;">
                                {{ $worker->observations }}&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
