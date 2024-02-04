
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="name" id="name" class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}" value="{{ isset($department)?$department->name:'' }}" autocomplete="{{ old('name') }}" required>
                </div>
            </div>
            {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('area_id')?'class="text-danger"':'' }}> {{ trans('messages.Area.Area') }} </span>
                    </small>
                    {!! Form::select('area_id', $areaSelect,null,[
                        'class'=>'form-control form-select select2'.(($errors)->has('area_id')?'is-invalid':''),
                    ]) !!}
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Details') }}</span>
                    </small>
                    <input type="text" name="description" id="description" class="form-control  {{ (($errors)->has('description')?'is-invalid':'') }}" value="{{ isset($department)?$department->description:'' }}" autocomplete="{{ old('description') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <small>
                    <span>{{ trans('messages.Areas') }}</span>
                </small>
                <div class="example">
                    @if ($areas->count()>0)
                        <div class="form-group m-0">
                            <div class="custom-controls-stacked">
                                @foreach ($areas as $area)
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            name="areas[]"
                                            class="custom-control-input"
                                            value="{{ $area->id }}" {{ isset($department)&&$department->areas->contains($area->id)?'checked':'' }}>
                                        <span class="custom-control-label"><span class="fw-bold">{{ $area->name}}.</span> {{ $area->description }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            {{ trans('messages.Info.NoRecordsFound') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase submit-prevent-button"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.departments.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
            </div>
        </div>
    </div>


