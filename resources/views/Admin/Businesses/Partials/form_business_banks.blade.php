<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.BankAccount.BankAccounts') }}
    </div>
    <div class="card-body">
        <div class="row">
            @if ($business->bankAccounts->first())
                <div class="col-12 table-responsive mb-3">
                    <table id="bank_account_table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="border-bottom-0"><small>id</small></th>
                            <th class="border-bottom-0"><small>{{ trans('messages.BankAccount.BankAccount') }}</small></th>
                            <th class="border-bottom-0"><small>BIC/SWIFT</small></th>
                            <th class="border-bottom-0"><small>IBAN</small></th>
                            <th class="border-bottom-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($business->bankAccounts as $bankAccount)
                            <tr>
                                <td class="py-2">{{ $bankAccount->id }}</td>
                                <td class="py-2">{{ $bankAccount->name }}</td>
                                <td class="py-2">{{ $bankAccount->bic }}</td>
                                <td class="py-2">{{ $bankAccount->iban }}</td>
                                <td class="py-2" class="text-right">
                                    @can('businesses.edit')
                                        <input type="hidden" name="bankAcount" value="{{ $bankAccount->id }}">
                                        <button type="submit" class="btn text-danger btn-sm py-0"><i class="fe fe-minus-circle"></i></button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="col-12 text-center">
                <h3>
                    <a class="modal-effect btn btn-info-light"
                        data-bs-toggle="modal"
                        href="#modalSelectBankAccount">
                        <i class="fe fe-plus-circle"></i> &nbsp;{{ trans('messages.BankAccount.AddBankAccount') }}
                    </a>
                </h3>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="mb-0 mt-4 row justify-content-end">
            <div class="col-12">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
            </div>
        </div>
    </div>
</div>
