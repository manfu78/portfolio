<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.OtherData') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('vat_id')?'class="text-danger"':'' }}> {{ trans('messages.Vat.Vats') }} </span>
                    </small>
                    <select name="vat_id" class="form-control select2 form-select {{ (($errors)->has('vat_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Vat.Vat') }}">
                        @foreach($vats as $vatId => $vatName)
                            <option value="{{ $vatId }}" @if (isset($business)){{ $vatId == $business->vat_id ? 'selected' : '' }}@endif>
                            {{ $vatName }}
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
