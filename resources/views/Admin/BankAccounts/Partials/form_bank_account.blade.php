<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-info"></i></span>&nbsp;{{ trans('messages.AccountNumber') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('bic')?'class="text-danger"':'' }}>BIC/SWIFT</span>
                    </small>
                    <input type="text" name="bic" id="bic"
                    class="form-control {{ (($errors)->has('bic')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->bic:'' }}"
                    onkeyup="this.value = this.value.toUpperCase()">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('iban')?'class="text-danger"':'' }}>IBAN</span>
                    </small>
                    <input type="text" name="iban" id="iban"
                    class="form-control  {{ (($errors)->has('iban')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->iban:'' }}"
                    autocomplete="iban"
                    onkeyup="this.value = this.value.toUpperCase();"
                    maxlength="24">
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
