
<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.Address') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('address')?'class="text-danger"':'' }}>{{ trans('messages.Address') }}</span>
                    </small>
                    <input type="text" name="address" id="address"
                    class="form-control  {{ (($errors)->has('address')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->address:'' }}"
                    autocomplete="address">
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('postal_code')?'class="text-danger"':'' }}>C.P.</span>
                    </small>
                    <input type="text" name="postal_code" id="postal_code"
                    class="form-control  {{ (($errors)->has('postal_code')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->postal_code:'' }}"
                    autocomplete="postal_code">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('city')?'class="text-danger"':'' }}>{{ trans('messages.City') }}</span>
                    </small>
                     <input type="text" name="city" id="city"
                     class="form-control  {{ (($errors)->has('city')?'is-invalid':'') }}"
                     value="{{ isset($bankAccount)?$bankAccount->city:'' }}"
                     autocomplete="city">
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('province')?'class="text-danger"':'' }}>{{ trans('messages.Province') }}</span>
                    </small>
                    <input type="text" name="province" id="province"
                    class="form-control  {{ (($errors)->has('province')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->province:'' }}"
                    autocomplete="province">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            </div>
        </div>
    </div>
</div>
