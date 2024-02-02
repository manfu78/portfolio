
<div class="card-body">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('vat')?'class="text-danger"':'' }}>{{ trans('messages.Vat.Vat') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="number" name="vat" id="vat"
                    class="form-control {{ (($errors)->has('vat')?'is-invalid':'') }}"
                    value="{{ isset($vat)?$vat->vat:old('vat') }}"
                    step="0.01"
                    autocomplete="vat"
                    required>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('surcharge')?'class="text-danger"':'' }}>{{ trans('messages.Vat.Surcharge') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="number" name="surcharge" id="surcharge"
                    class="form-control {{ (($errors)->has('surcharge')?'is-invalid':'') }}"
                    value="{{ isset($vat)?$vat->surcharge:old('surcharge') }}"
                    step="0.01"
                    autocomplete="surcharge"
                    required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Description') }}</span>
                </small>
                <input type="text" name="description" id="description" class="form-control" autocomplete="description" value="{{ isset($vat)?$vat->description:old('description') }}">
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.vats.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
        </div>
    </div>
</div>


