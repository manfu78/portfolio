<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-map"></i></span>&nbsp;{{ trans('messages.Address') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('address')?'class="text-danger"':'' }}> {{ trans('messages.Address') }} </span>
                    </small>
                    <input type="text" name="address"
                    class="form-control  {{ (($errors)->has('address')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->address:'' }}"
                    autocomplete="address"
                    maxlength="255">
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('postal_code')?'class="text-danger"':'' }}> C.P. </span>
                    </small>
                    <input type="text" name="postal_code"
                    class="form-control  {{ (($errors)->has('postal_code')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->postal_code:'' }}"
                    autocomplete="postal_code"
                    maxlength="5">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('cyty')?'class="text-danger"':'' }}> {{ trans('messages.City') }} </span>
                    </small>
                    <input type="text" name="city"
                    class="form-control  {{ (($errors)->has('city')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->city:'' }}"
                    autocomplete="city"
                    maxlength="255">
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('province')?'class="text-danger"':'' }}> {{ trans('messages.Province') }} </span>
                    </small>
                    <input type="text" name="province"
                    class="form-control  {{ (($errors)->has('province')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->province:'' }}"
                    autocomplete="province"
                    maxlength="255">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('country_id')?'class="text-danger"':'' }}> {{ trans('messages.Country.Country') }} </span>
                    </small>
                    <select name="country_id" class="form-control select2 form-select {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                        data-bs-placeholder="{{ __('Select') . ' ' . trans('messages.Country.Country') }}">
                        @foreach ($countries as $countryId => $countryName)
                            <option value="{{ $countryId }}" @if (isset($business) ? ($countryId == $business->country_id) : ($countryId == 73)) selected @endif>
                                {{ $countryName }}
                            </option>
                        @endforeach
                    </select>
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
