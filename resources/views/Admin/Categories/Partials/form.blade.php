
<div class="card-body">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="text" name="name" id="name"
                    class="form-control {{ (($errors)->has('name')?'is-invalid':'') }}"
                    value="{{ isset($category)?$category->name:old('name') }}"
                    autocomplete="name"
                    required>
            </div>
        </div>
        <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('hour_price')?'class="text-danger"':'' }}> {{ trans('messages.HourPrice') }} </span>
                    <span class="text-red">*</span>
                </small>
                <input type="number" name="hour_price" id="hour_price"
                    class="form-control {{ (($errors)->has('hour_price')?'is-invalid':'') }}"
                    value="{{ isset($category)?$category->hour_price:0 }}"
                    autocomplete="hour_price"
                    step="0.01"
                    required>
            </div>
        </div>
        <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('unit_price')?'class="text-danger"':'' }}>{{ trans('messages.UnitPrice') }}</span>
                    <span class="text-red">*</span>
                </small>
                <input type="number" name="unit_price" id="unit_price"
                    class="form-control {{ (($errors)->has('unit_price')?'is-invalid':'') }}"
                    value="{{ isset($category)?$category->unit_price:0 }}"
                    autocomplete="unit_price"
                    step="0.01"
                    required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <small>
                    <span {{ ($errors)->has('details')?'class="text-danger"':'' }}>{{ trans('messages.Details') }}</span>
                </small>
                <input type="text" name="details" id="details"
                class="form-control {{ (($errors)->has('details')?'is-invalid':'') }}"
                value="{{ isset($category)?$category->details:old('details') }}"
                autocomplete="details">
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase submit-prevent-button"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.categories.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
        </div>
    </div>
</div>


