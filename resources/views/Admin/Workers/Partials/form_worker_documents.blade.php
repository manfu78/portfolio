<div class="row">
    <div class="col">
        <div class="card" id="worker_documents">
            <div class="card-header bg-info-transparent p-2">
                <span class="fw-bold"><i class="fe fe-file-text"></i></span>&nbsp;{{ trans('messages.Document.Documents') }}
            </div>

            <div class="card-body p-2">
                <div class="row">
                    <div class="col">
                        <div class="media d-flex">
                            @if ($worker->photo)
                                <span class="me-2">
                                    <img id="photo" class="avatar brround cover-image" src="{{ Storage::url($worker->photo) }}" onerror="this.src='/assets/images/profileimg.png'" style="width: 75px;height: 75px;object-fit: cover;">
                                </span>
                            @else
                                <span class="avatar avatar-xxl brround bg-default mx-4">
                                    {{ substr($worker->name,0,1).substr($worker->lastname,0,1) }}
                                </span>
                            @endif
                            <div class="media-body">
                                <h4 class="font-weight-semibold mb-1">{{ $worker->full_name }}</h4>
                                @if ($worker->phone)
                                    <span><a href="Tel:{{ $worker->phone }}"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;{{ $worker->phone }}</a></span>
                                @endif
                                @if ($worker->email)
                                    <p class="m-0">
                                        <a href="mailto:{{$worker->email}}"><small><i class="fa-solid fa-envelope"></i>:</small>&nbsp;{{$worker->email}}</a>
                                    </p>
                                @endif
                                @if ($worker->phone)
                                    <p class="m-0">
                                        <a href="tel:{{$worker->phone}}"><small><i class="fa-solid fa-phone"></i>:</small>&nbsp;{{$worker->phone}}</a>
                                    </p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-2">
                <div class="row">
                    <div class="col">
                        <button type="button" class="modal-effect btn btn-sm btn-outline-success text-uppercase"
                            data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalAddFile">
                            <span class="fa fa-plus"></span>&nbsp;&nbsp;{{ trans('messages.New') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($worker->documents->count()>0)
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
                                @foreach($worker->documents as $workerDocument)
                                    <tr>
                                        <td class="py-1 fw-bold" style="width: 10px;">{{ $workerDocument->id }}</td>
                                        <td class="py-1" style="width: 50px;"><span>{{ date('m/d/Y', strtotime($workerDocument->created_at)) }}</span></td>
                                        <td class="py-1"><span>{{ $workerDocument->name }}</span></td>
                                        <td class="py-1"><span>{{ $workerDocument->documentType->type }}</span></td>
                                        <td class="py-1 text-center"  style="width: 30px;">
                                            <a href="{{ Storage::url( $workerDocument->file) }}" target="_blank">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="py-1 text-nowrap text-end" style="width: 30px;">
                                            @can('workers.edit')
                                                <a class="modal-effect btn text-danger btn-sm py-0"
                                                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                    data-name="{{ $workerDocument->name }}"
                                                    data-route="{{ route('admin.workers.deleteDocument',$workerDocument) }}">
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
                    <form action="{{ route('admin.workers.addDocument',$worker) }}" method="post" name="form_worker_store" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            @include('Admin.Workers.Partials.form-worker-modal-documents')
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

