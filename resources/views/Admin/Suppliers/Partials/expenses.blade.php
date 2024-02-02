<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <h3 class="card-title fw-bold"><i class="fe fe-info"></i>&nbsp;{{ trans('messages.Expense.Expenses') }}</h3>
    </div>
    <div class="card-body py-2">
        <div class="row">
            <div class="col">
                <button type="button" class="modal-effect btn btn-sm btn-outline-success text-uppercase"
                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalAddFile">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;{{ trans('messages.AddFile') }}
                </button>
            </div>
        </div>
    </div>
    <div class="card-body py-2">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="documents_table" class="table mb-0">
                        <thead>
                            <tr class="bg-primary-transparent">
                                <th class="p-2"><small>{{ trans('messages.Name') }}</small></th>
                                <th class="p-2"><small>{{ trans('messages.Description') }}</small></th>
                                <th class="p-2"><small>{{ trans('messages.Amount') }}</small></th>
                                <th class="p-2 text-center"><small><i class="fa-solid fa-file-lines"></i></small></th>
                                {{-- <th class="p-2"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplier->expenses as $supplierExpense)
                                <tr>
                                    <td><span>{{ $supplierExpense->name }}</span></td>
                                    <td><span>{{ $supplierExpense->description }}</span></td>

                                    <td><span>{{ number_format(($supplierExpense->total), 2, ',','.').' '.$supplierExpense->coinType->sign }}</span></td>
                                    <td class="text-center">
                                        @if ($supplierExpense->documents->count()>0)
                                            <a href="{{ Storage::url( $supplierExpense->documents->first()->file) }}" target="_blank">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        @endif
                                    </td>
                                    {{-- @can('suppliers.edit')
                                        <td class="text-nowrap" style="width: 60px;text-align: right;">
                                            <a class="modal-effect btn text-danger btn-sm py-0"
                                                data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                data-name="{{ $supplierExpense->name }}"
                                                data-route="{{ route('admin.suppliers.deleteDocument',$supplierExpense->id) }}">
                                                <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                    <i class="fe fe-trash"></i>
                                                </div>
                                            </a>
                                        </td>
                                    @endcan --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
