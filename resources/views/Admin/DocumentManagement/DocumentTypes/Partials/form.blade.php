<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('type')?'class="text-danger"':'' }}>{{ trans('messages.Type') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="text" name="type" id="type" class="form-control {{ (($errors)->has('type')?'is-invalid':'') }}" value="{{ isset($documentType)?$documentType->type:old('type') }}" autocomplete="type" required>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.documentTypes.index') }}"><i class="fa fa-close"></i>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
        </div>
    </div>
</div>


