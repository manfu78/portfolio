
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="form-label {{ ($errors)->has('default')?'text-danger':'' }} m-0"><small> &nbsp;</small></label>
                <div class="custom-controls-stacked">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="default" class="custom-control-input" value="1" {{ isset($coinType)&&$coinType->default==1?'checked':'' }}>
                        <span class="custom-control-label">{{ trans('messages.DefaultCoin') }}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="text" name="name" id="name" class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}" value="{{ isset($coinType)?$coinType->name:'' }}" autocomplete="{{ old('name') }}" required>
            </div>
        </div>
        <div class="col-6 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('code')?'class="text-danger"':'' }}>CODE</span>
                    <span class="text-red">*</span>
                </small>
                <input type="text" name="code" id="code" class="form-control  {{ (($errors)->has('code')?'is-invalid':'') }}" value="{{ isset($coinType)?$coinType->code:'' }}" autocomplete="{{ old('code') }}" required>
            </div>
        </div>
        <div class="col-6 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('sign')?'class="text-danger"':'' }}>{{ trans('messages.Sign') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="text" name="sign" id="sign" class="form-control  {{ (($errors)->has('sign')?'is-invalid':'') }}" value="{{ isset($coinType)?$coinType->sign:'' }}" autocomplete="{{ old('sign') }}" required>
            </div>
        </div>
        <div class="col-6 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('sign_html')?'class="text-danger"':'' }}>{{ trans('messages.SignHtml') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="text" name="sign_html" id="sign_html" class="form-control  {{ (($errors)->has('sign_html')?'is-invalid':'') }}" value="{{ isset($coinType)?$coinType->sign_html:'' }}" autocomplete="{{ old('sign_html') }}" required>
            </div>
        </div>
        <div class="col-6 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('equivalence')?'class="text-danger"':'' }}>{{ trans('messages.Equivalence') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="number" name="equivalence" id="equivalence"
                    class="form-control {{ (($errors)->has('equivalence')?'is-invalid':'') }}"
                    value="{{ isset($coinType)?$coinType->equivalence:old('equivalence') }}"
                    step="0.01" min="0" required>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.coinTypes.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
        </div>
    </div>
</div>

