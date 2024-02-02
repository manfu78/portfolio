<div class="card">
    <div class="card-header bg-info-transparent p-2">
        @if (isset($customer))
            <span class="fw-bold"><i class="fa-solid fa-pen-to-square"></i></span>&nbsp;{{ trans('messages.Customer.EditCustomer') }}
        @else
            <span class="fw-bold"><i class="fe fe-file-plus"></i></span>&nbsp;{{ trans('messages.Customer.CreateCustomer') }}
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-7 col-md-7 col-lg-8 col-xl-8 col-xxl-8">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('status')?'class="text-danger"':'' }}> {{ trans('messages.Active') }}</span>
                    </small>
                    <div class="form-control-plaintext material-switch pull-right">
                        <input type="checkbox"
                            name="status" id="switchStatus"
                            class="custom-control-input"
                            value="1" @if (isset($customer)) {{  $customer->status? 'checked':'' }} @else checked @endif>
                        <label for="switchStatus" class="label-success"></label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('ncc')?'class="text-danger"':'' }}> NCC</span>
                    </small>
                    <input type="text" name="ncc"
                        class="form-control  {{ (($errors)->has('ncc')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->ncc:'' }}"
                        autocomplete="ncc"
                        onkeyup="this.value = this.value.toUpperCase();"
                        max="255">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}> {{ trans('messages.TaxName') }} </span>
                        @if (request()->routeIs('admin.customer.create')) <span class="text-red">*</span> @endif
                    </small>
                    <input type="text" name="name"
                        class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->name:'' }}"
                        autocomplete="name"
                        maxlength="255"
                        placeholder="{{ trans('messages.TaxName').' S.L...' }}"
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
                        value="{{ isset($customer)?$customer->tradename:'' }}"
                        autocomplete="tradename"
                        maxlength="255"
                        placeholder="{{ trans('messages.Tradename') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('cif')?'class="text-danger"':'' }}>CIF/NIF</span>
                        @if (request()->routeIs('admin.customer.create')) <span class="text-red">*</span> @endif
                    </small>
                    <input type="text" name="cif"
                        class="form-control  {{ (($errors)->has('cif')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->cif:'' }}"
                        autocomplete="cif"
                        max="9">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('phone')?'class="text-danger"':'' }}>{{ trans('messages.Phone') }}</span>
                    </small>
                    <input type="text" name="phone"
                        class="form-control  {{ (($errors)->has('phone')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->phone:'' }}"
                        autocomplete="phone"
                        max="255">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('email')?'class="text-danger"':'' }}>{{ trans('messages.Email') }}</span>
                        @if (request()->routeIs('admin.customer.create')) <span class="text-red">*</span> @endif
                    </small>
                    <input type="email" name="email"
                        class="form-control  {{ (($errors)->has('email')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->email:old('email') }}"
                        maxlength="255">
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

@if (isset($customer))
    <div class="card">
        <div class="card-header bg-info-transparent p-2">
            <span class="fw-bold"><i class="fe fe-users"></i></span>&nbsp;{{ trans('messages.Contact.Contacts') }}
        </div>
        <div class="card-body">
            @if ($customer->customerContacts->count()>0)
                <div class="row mb-3">
                    <div class="col-12 table-responsive">
                        <table id="bank_account_table" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="border-bottom-0 py-1" style="width: 10px;"><small>id</small></th>
                                <th class="border-bottom-0 py-1"><small>{{ trans('messages.Contact.Contact') }}</small></th>
                                <th class="border-bottom-0 py-1"><small>{{ trans('messages.Phone') }}</small></th>
                                <th class="border-bottom-0 py-1"><small>{{ trans('messages.Email') }}</small></th>
                                <th class="border-bottom-0 py-1"><small>{{ trans('messages.Position') }}</small></th>
                                <th class="border-bottom-0 py-1" style="width: 60px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->customerContacts as $contact)
                                <tr>
                                    <td class="py-1 text-end" style="width: 10px;"><small>#{{ $contact->id }}</small></td>
                                    <td class="py-1">{{ $contact->contact }}</td>
                                    <td class="py-1">{{ $contact->phone }}</td>
                                    <td class="py-1">{{ $contact->email }}</td>
                                    <td class="py-1">{{ $contact->position }}</td>
                                    <td class="py-1 text-end text-nowrap" style="width: 60px;">
                                        @can('customers.edit')
                                            <a class="modal-effect btn text-danger btn-sm py-0"
                                                data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                data-name="{{ $contact->contact }}"
                                                data-route="{{ route('admin.customers.deleteContact',$contact->id) }}">
                                                <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                    <i class="fe fe-trash"></i>
                                                </div>
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 text-center">
                    <a class="modal-effect btn btn-info-light"
                        data-bs-toggle="modal"
                        href="#modalSelectCustomerContact">
                        <i class="fe fe-plus-circle"></i> &nbsp;{{ trans('messages.Contact.CreateContact') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

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
                    <input type="text"
                        name="address"
                        class="form-control {{ (($errors)->has('address')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->address:old('address') }}">
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('postal_code')?'class="text-danger"':'' }}> C.P. </span>
                    </small>
                    <input type="text"
                        name="postal_code"
                        class="form-control {{ (($errors)->has('postal_code')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->postal_code:old('postal_code') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-7 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('cyty')?'class="text-danger"':'' }}> {{ trans('messages.City') }} </span>
                    </small>
                    <input type="text"
                        name="city"
                        class="form-control {{ (($errors)->has('city')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->city:old('city') }}">
                </div>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('province')?'class="text-danger"':'' }}> {{ trans('messages.Province') }} </span>
                    </small>
                    <input type="text"
                        name="province"
                        class="form-control {{ (($errors)->has('province')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->province:old('province') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('country_id')?'class="text-danger"':'' }}> {{ trans('messages.Country.Country') }} </span>
                    </small>
                    <select name="country_id" class="form-control select2-show-search form-select {{ (($errors)->has('country_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Country.Country') }}">
                        @foreach($countrySelect as $countryId => $countryName)
                            <option value="{{ $countryId }}" @if (isset($customer) && $countryId == $customer->country_id) selected @else {{ $countryId == 73?'selected':'' }} @endif>
                            {{ $countryName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('latitude')?'class="text-danger"':'' }}> {{ trans('messages.Latitude') }} </span>
                    </small>
                    <input type="text"
                        name="latitude"
                        class="form-control {{ (($errors)->has('latitude')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->latitude:old('latitude') }}">
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('longitude')?'class="text-danger"':'' }}> {{ trans('messages.Longitude') }} </span>
                    </small>
                    <input type="text"
                        name="longitude"
                        class="form-control {{ (($errors)->has('longitude')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->longitude:old('longitude') }}">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            </div>
        </div>
    </div>
    {{-- <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            </div>
        </div>
    </div> --}}
</div>

<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.AccountNumber') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('bic')?'class="text-danger"':'' }}> BIC/SWIFT </span>
                    </small>
                    <input type="text" name="bic"
                        class="form-control  {{ (($errors)->has('bic')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->bic:'' }}"
                        autocomplete="bic"
                        onkeyup="this.value = this.value.toUpperCase();"
                        max="255">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('iban')?'class="text-danger"':'' }}> IBAN </span>
                    </small>
                    <input type="text" name="iban"
                        class="form-control  {{ (($errors)->has('iban')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->iban:'' }}"
                        autocomplete="iban"
                        onkeyup="this.value = this.value.toUpperCase();"
                        max="24"
                        min="24">
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

<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.Billing') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('vat_id')?'class="text-danger"':'' }}> {{ trans('messages.Vat.Vat') }} </span>
                    </small>
                    <select name="vat_id" class="form-control select2-show-search form-select {{ (($errors)->has('vat_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Vat.Vat') }}">
                        @foreach($vatSelect as $vatId => $vatName)
                            <option value="{{ $vatId }}" @if (isset($customer) && $vatId == $customer->vat_id) selected @else {{ $vatId == 73?'selected':'' }} @endif>
                            {{ $vatName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('comercial_discount')?'class="text-danger"':'' }}> %&nbsp;{{ trans('messages.ComercialDiscount') }} </span>
                    </small>
                    <input type="number" name="comercial_discount"
                        class="form-control {{ (($errors)->has('comercial_discount')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->comercial_discount:old('comercial_discount') }}"
                        step="0.01">
                </div>
            </div>
            <div class="col-12 col-sm-3 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('pront_payment_discount')?'class="text-danger"':'' }}> %&nbsp;{{ trans('messages.ProntPaymentDiscount') }} </span>
                    </small>
                    <input type="number" name="pront_payment_discount"
                        class="form-control {{ (($errors)->has('pront_payment_discount')?'is-invalid':'') }}"
                        value="{{ isset($customer)?$customer->pront_payment_discount:old('pront_payment_discount') }}"
                        step="0.01">
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

<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.OtherData') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('observations')?'class="text-danger"':'' }}> {{ trans('messages.Observations') }} </span>
                    </small>
                    <textarea name="observations"
                        class="form-control {{ (($errors)->has('observations')?'is-invalid':'') }}"
                        rows="3">{{ isset($customer)?$customer->observations:old('observations') }}</textarea>
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
