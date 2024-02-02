<div class="row">
    <div class="col">
        <div class="card" id="business_documents">
            <div class="card-header bg-info-transparent p-2">
                <h3 class="card-title fw-bold"><i class="fe fe-file-text"></i>&nbsp;{{ trans('messages.Document.Documents') }}</h3>
            </div>



            <div class="card-body p-2">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="text-dark">
                            <h5 class=" mb-1">
                                <i class="fa-solid fa-building"></i>:&nbsp;{{ $business->name }}
                            </h5>
                            <h5 class="text-muted m-0"><small><i class="fa-solid fa-envelope"></i>:</small>&nbsp;<a href="mailto:{{ $business->email  }}">{{ $business->email }}</a></h5>
                            <h5 class="text-muted m-0"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;<a href="tel:{{ $business->phone }}">{{ $business->phone }}</a></h5>
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
                @if ($business->documents->count()>0)
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
                                @foreach($business->documents as $businessDocument)
                                    <tr>
                                        <td class="py-1 fw-bold" style="width: 10px;">{{ $businessDocument->id }}</td>
                                        <td class="py-1" style="width: 50px;"><span>{{ date('m/d/Y', strtotime($businessDocument->created_at)) }}</span></td>
                                        <td class="py-1"><span>{{ $businessDocument->name }}</span></td>
                                        <td class="py-1"><span>{{ $businessDocument->documentType->type }}</span></td>
                                        <td class="py-1 text-center">
                                            <a href="{{ Storage::url( $businessDocument->file) }}" target="_blank">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="py-1 text-nowrap" style="width: 30px;text-align: right;">
                                            @can('businesses.edit')
                                                <a class="modal-effect btn text-danger btn-sm py-0"
                                                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                    data-name="{{ $businessDocument->name }}"
                                                    data-route="{{ route('admin.businesses.deleteDocument',$businessDocument) }}">
                                                    <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                        <i class="fe fe-trash"></i>
                                                    </div>
                                                </a>
                                            @else
                                                <button type="button" class="btn text-default btn-sm py-0" disabled>
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
                    <form action="{{ route('admin.businesses.addDocument',$business) }}" method="post" name="form_businesses_addDocument" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            @include('Admin.Businesses.Partials.form-modal-documents')
                        </div>
                        <div class="modal-footer py-1">
                            <button class="btn btn-sm ripple btn-outline-success" type="submit">
                                <span class="fa fa-save"></span>&nbsp;{{ trans('messages.Save') }}
                            </button>
                            <button class="btn btn-sm ripple btn-outline-default" data-bs-dismiss="modal" type="button">
                                <span class="fa fa-close"></span>&nbsp;{{ trans('messages.Cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

