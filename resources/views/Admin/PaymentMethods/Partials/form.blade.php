
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.PaymentMethod.PaymentMethod') }}</span>
                        @if (request()->routeIs('admin.paymentMethods.create')) <span class="text-red">*</span>@endif
                    </small>
                    <input type="text" name="name" id="name" class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}" value="{{ isset($paymentMethod)?$paymentMethod->name:'' }}" autocomplete="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('postponement_days')?'class="text-danger"':'' }}>{{ trans('messages.PostponementDays') }}</span>
                        @if (request()->routeIs('admin.paymentMethods.create')) <span class="text-red">*</span>@endif
                    </small>
                    <input type="number" name="postponement_days" id="postponement_days"
                        class="form-control {{ (($errors)->has('postponement_days')?'is-invalid':'') }}"
                        value="{{ isset($paymentMethod)?$paymentMethod->postponement_days:0 }}"
                        step="1" min="0">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.paymentMethods.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
            </div>
        </div>
    </div>

