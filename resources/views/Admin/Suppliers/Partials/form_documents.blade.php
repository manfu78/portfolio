<div class="row">
    <div class="col">
        <div class="card" id="supplier_documents">
            <div class="card-header bg-info-transparent p-2">
                <h3 class="card-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.Document.Documents') }}</h3>
            </div>
            <div class="card-body p-2">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="text-dark">
                            <h5 class=" mb-1">
                                <i class="fa-solid fa-building"></i>:&nbsp;{{ $supplier->name }}
                            </h5>
                            <h5 class="text-muted m-0"><small><i class="fa-solid fa-envelope"></i>:</small>&nbsp;<a href="mailto:{{ $supplier->email  }}">{{ $supplier->email }}</a></h5>
                            <h5 class="text-muted m-0"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;<a href="tel:{{ $supplier->phone }}">{{ $supplier->phone }}</a></h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" class="modal-effect btn btn-sm btn-outline-success text-uppercase"
                            data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalAddFile">
                            <span class="fa fa-plus"></span>&nbsp;&nbsp;{{ trans('messages.Document.NewDocument') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($supplier->documents->count()>0)
                    <div class="table-responsive">
                        <table id="documents_table" class="table table-bordered border-bottom">
                            <thead>
                                <tr class="bg-primary-transparent">
                                    <th class="p-2" style="width: 10px;"><small>id</small></th>
                                    <th class="p-2"><small>{{ trans('messages.Date') }}</small></th>
                                    <th class="p-2"><small>{{ trans('messages.Name') }}</small></th>
                                    <th class="p-2"><small>{{ trans('messages.Type') }}</small></th>
                                    <th class="p-2 text-center" style="width: 30px;"><small><i class="fa-solid fa-file-lines"></i></small></th>
                                    <th class="p-2" style="width: 30px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier->documents as $supplierDocument)
                                    <tr>
                                        <td class="py-1 fw-bold" style="width: 10px;">{{ $supplierDocument->id }}</td>
                                        <td class="py-1" style="width: 50px;"><span>{{ date('m/d/Y', strtotime($supplierDocument->created_at)) }}</span></td>
                                        <td class="py-1"><span>{{ $supplierDocument->name }}</span></td>
                                        <td class="py-1"><span>{{ $supplierDocument->documentType->type }}</span></td>
                                        <td class="py-1 text-center">
                                            <a href="{{ Storage::url( $supplierDocument->file) }}" target="_blank">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="py-1 text-nowrap" style="width: 30px;text-align: right;">
                                            @can('partials.edit')
                                                <a class="modal-effect btn text-danger btn-sm py-0"
                                                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                    data-name="{{ $supplierDocument->name }}"
                                                    data-route="{{ route('admin.suppliers.deleteDocument',$supplierDocument) }}">
                                                    <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                        <i class="fe fe-trash"></i>
                                                    </div>
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-sm btn-icon btn-danger" disabled>
                                                    <i class="fe fe-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="row">
                        <div class="col text-center">
                            {{ trans('messages.Info.NoRecordsFound') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Modal para añadir fichero --}}
        <div class="modal fade" id="modalAddFile">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header bg-primary-transparent py-1">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-file"></i>&nbsp;{{ trans('messages.Document.Document') }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    {!! Form::open(array('route'=>['admin.suppliers.addDocument',$supplier],'method'=>'POST','name'=>'form_add_document','enctype'=>'multipart/form-data')) !!}
                    @csrf
                        <div class="modal-body">
                            @include('Admin.DocumentManagement.Documents.Partials.form-documents')
                        </div>
                        <div class="modal-footer py-1">
                            <button class="btn btn-sm ripple btn-outline-success" type="submit">
                                <span class="fa fa-save"></span>&nbsp;{{ trans('messages.Save') }}
                            </button>
                            <button class="btn btn-sm ripple btn-outline-default" data-bs-dismiss="modal" type="button">
                                <span class="fa fa-close"></span>&nbsp;{{ trans('messages.Cancel') }}
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

