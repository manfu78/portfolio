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
                                <span {{ ($errors)->has('observations')?'class="text-danger"':'' }}> {{ trans('messages.Observations') }} </span>
                            </small>
                            <textarea name="observations" rows="4" class="form-control {{ (($errors)->has('observations')?'is-invalid':'') }}">{{ isset($worker)?$worker->observations:'' }}</textarea>
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
