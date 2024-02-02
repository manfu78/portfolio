
<div class="card-body">
    <div class="row">
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('code')?'class="text-danger"':'' }}>{{ trans('messages.Code') }}</span>
                    <span class="text-red">*</span>
                </small>
            <input type="text" name="code" id="code"
                class="form-control {{ (($errors)->has('code')?'is-invalid':'') }}"
                value="{{ isset($country)?$country->code:old('code') }}"
                autocomplete="code"
                required>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('iso1')?'class="text-danger"':'' }}>ISO1</span>
                    <span class="text-red">*</span>
                </small>
            <input type="text" name="iso1" id="iso1"
                class="form-control {{ (($errors)->has('iso1')?'is-invalid':'') }}"
                value="{{ isset($country)?$country->iso1:old('iso1') }}"
                autocomplete="iso1"
                required>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('iso2')?'class="text-danger"':'' }}>ISO2</span>
                    <span class="text-red">*</span>
                </small>
            <input type="text" name="iso2" id="iso2"
                class="form-control {{ (($errors)->has('iso2')?'is-invalid':'') }}"
                value="{{ isset($country)?$country->iso2:old('iso2') }}"
                autocomplete="iso2"
                required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                    <span class="text-red">*</span>
                </small>
            <input type="text" name="name" id="name"
                class="form-control {{ (($errors)->has('name')?'is-invalid':'') }}"
                value="{{ isset($country)?$country->name:old('name') }}"
                autocomplete="name"
                required>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.countries.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
        </div>
    </div>
</div>


