<div class="card">
    <div class="card-header bg-info-transparent p-2">
        @if (isset($bankAccount))
            <span class="fw-bold"><i class="fe fe-edit"></i></span>&nbsp;{{ trans('messages.BankAccount.EditBankAccount') }}
        @else
            <span class="fw-bold"><i class="fe fe-file-plus"></i></span>&nbsp;{{ trans('messages.BankAccount.CreateBankAccount') }}
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="name" id="name"
                    class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->name:'' }}"
                    autocomplete="name" required>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('ncc')?'class="text-danger"':'' }}>N.C.C.</span>
                    </small>
                    <input type="text" name="ncc" id="ncc"
                    class="form-control  {{ (($errors)->has('ncc')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->ncc:'' }}"
                    autocomplete="ncc">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>{{ trans('messages.Email') }}</span>
                    </small>
                    <input type="text" name="email" id="email"
                    class="form-control  {{ (($errors)->has('email')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->email:'' }}"
                    autocomplete="email">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('phone')?'class="text-danger"':'' }}>{{ trans('messages.Phone') }}</span>
                    </small>
                    <input type="text" name="phone" id="phone"
                    class="form-control  {{ (($errors)->has('phone')?'is-invalid':'') }}"
                    value="{{ isset($bankAccount)?$bankAccount->phone:'' }}"
                    autocomplete="phone">
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
