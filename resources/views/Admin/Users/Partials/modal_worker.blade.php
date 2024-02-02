<div class="modal fade" id="modalSelectWorker">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h4 class="modal-title fw-bold"><i class="fe fe-users"></i>&nbsp;{{ trans('messages.Worker.Workers') }}</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if ($workers->first())
                    <table id="workers_table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="border-bottom-0"><small>Imag.</small></th>
                            <th class="border-bottom-0"><small>{{ trans('messages.Name') }}</small></th>
                            <th class="border-bottom-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $worker)
                            <tr>
                                <td>
                                    @if ($worker->photo)
                                        <span class="avatar avatar-sm brround cover-image" data-bs-image-src="{{ Storage::url($worker->photo) }}">
                                            @if ($worker->user)
                                                <span class="avatar-status bg-green"></span>
                                            @endif
                                        </span>
                                    @else
                                        <span class="avatar avatar-sm brround cover-image" data-bs-image-src="/dist/img/profileimg.png">
                                        @if ($worker->user)
                                            <span class="avatar-status bg-green"></span>
                                        @endif
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: left"><b>{{ $worker->full_name }}</b></td>
                                <td class="text-right">
                                    @can('users.edit')
                                        <a href="{{ route('admin.users.setWorker',[$user,$worker]) }}">
                                            <button type="submit" class="btn btn-sm btn-green"><i class="fe fe-plus-circle fw-bold"></i></button>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-12 text-center">
                        <span>{{ trans('messages.Worker.NoWorkers') }}</span>
                        @can('workers.create')
                            <h1><a href="{{ route('admin.workers.create') }}"><i class="fa-solid fa-circle-plus text-success"></i></a></h1>
                        @endcan
                    </div>

                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">{{ trans('messages.Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
