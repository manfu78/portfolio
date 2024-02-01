<div class="modal fade" id="modalSelectUser">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h4 class="modal-title fw-bold"><i class="fe fe-users"></i>&nbsp;{{ trans('messages.User.Users') }}</h4><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @if ($users->first())
                    <table id="users_table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="border-bottom-0"><small>id</small></th>
                            <th class="border-bottom-0"><small>{{ trans('messages.Username') }}</small></th>
                            <th class="border-bottom-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td style="text-align: left">
                                    <b>
                                        {!! $user->worker ? ('<span class="text-success"><i class="fa-solid fa-circle"></i></span>'):'&nbsp;' !!}&nbsp;
                                        {{ $user->name }}
                                    </b>
                                </td>
                                <td class="text-right">
                                    @can('workers.edit')
                                        <a href="{{ route('admin.workers.setUser',[$worker,$user]) }}" class="btn btn-sm btn-green"><i class="fe fe-plus-circle fw-bold"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-12 text-center">
                        <span>{{ trans('messages.Worker.NoWorkers') }}</span>
                        @can('users.create')
                            <h1><a href="{{ route('users.create') }}"><i class="fa-solid fa-circle-plus text-success"></i></a></h1>
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
