<div class="card">
    <div class="card-body">
        <div class="row">
            <label class="form-label">Rol</label>
            <div class="input-group mb-4">
                {!! Form::text('name', null, array(
                    'class'=>'form-control '. (($errors)->has('name') ? 'is-invalid state-invalid':''),
                    'value'=>old('name'),
                    'placeholder'=>'...','value'=>old('name')
                )) !!}
                <button type="submit" class="input-group-text btn btn-primary shadow-none">
                    <i class="fa fa-save"></i> &nbsp;{{ trans('messages.Save') }}
                </button>
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="card-body">
        @if (request()->routeIs('admin.roles.edit'))
            <div class="row">
                <div class="col-12 mb-4">
                    @if ($showAll=='true')
                        <span><a href="{{ route('admin.roles.edit', $role) }}">{{ trans('messages.HideAll') }}&nbsp;<i class="fe fe-chevrons-down"></i></a></span>
                    @else
                        <span><a href="{{ route('admin.roles.edit', $role) }}?showAll=true">{{ trans('messages.ShowAll') }}&nbsp;<i class="fe fe-chevrons-down"></i></a></span>
                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                @foreach ($appModels as $appModel )
                    <div class="accordion mb-3" id="accordionPermissions_{{ $appModel->id }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header bg-default" id="headingTwo_{{ $appModel->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo_{{ $appModel->id }}" aria-expanded="false" aria-controls="collapseTwo_{{ $appModel->id }}">
                                    <i class="fa-solid fa-shield-halved"></i>&nbsp;{{ trans('messages.'.$appModel->name.'.'.$appModel->name) }}
                                </button>
                            </h2>
                            <div id="collapseTwo_{{ $appModel->id }}" class="accordion-collapse collapse {{ $showAll=='true' ?'show':'' }}" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="form-group m-0">
                                        <div class="custom-controls-stacked">
                                            @foreach ($appModel->permissions as $permission)
                                                 <label class="custom-control custom-checkbox">
                                                    {{ Form::checkbox('permissions[]',$permission->id,null,['class'=>'custom-control-input']) }}
                                                    <span class="custom-control-label">{{ trans('messages.'.$appModel->name.'.'.str_replace(' ','',$permission->description)) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.roles.index') }}"><i class="fa fa-close"></i>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
            </div>
        </div>
    </div>
</div>
