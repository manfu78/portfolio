<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.Information') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group m-0">
                    <div class="custom-controls-stacked">
                        <label class="custom-control custom-checkbox-md">
                            <input type="checkbox"
                                name="default"
                                class="custom-control-input"
                                value="1" @if (isset($business)) {{  $business->default? 'checked':'' }} @endif>
                            <span class="custom-control-label">{{ trans('messages.Business.BusinessDefault') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}> {{ trans('messages.Name') }} </span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="name"
                    class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->name:'' }}"
                    autocomplete="name"
                    maxlength="255"
                    required>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('tradename')?'class="text-danger"':'' }}> {{ trans('messages.Tradename') }} </span>
                    </small>
                    <input type="text" name="tradename"
                    class="form-control  {{ (($errors)->has('tradename')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->tradename:'' }}"
                    autocomplete="tradename"
                    maxlength="255">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('cif')?'class="text-danger"':'' }}>CIF</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="cif"
                    class="form-control  {{ (($errors)->has('cif')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->cif:'' }}"
                    autocomplete="cif"
                    maxlength="10"
                    required>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('phone')?'class="text-danger"':'' }}>{{ trans('messages.Phone') }}</span>
                    </small>
                    <input type="text" name="phone"
                    class="form-control  {{ (($errors)->has('phone')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->phone:'' }}"
                    autocomplete="phone"
                    maxlength="255">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>{{ trans('messages.Email') }}</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="email" name="email" id="email"
                    class="form-control {{ (($errors)->has('email')?'is-invalid':'') }}"
                    value="{{ isset($business)?$business->email:'' }}"
                    required>
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
