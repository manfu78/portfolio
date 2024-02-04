
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="name" id="name" class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}" value="{{ isset($area)?$area->name:'' }}" autocomplete="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('business_id')?'class="text-danger"':'' }}> {{ trans('messages.Business.Business') }} </span>
                    </small>
                    <select name="business_id" class="form-control form-select select2 {{ (($errors)->has('business_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.Business.Business') }}">
                        @foreach($businessSelect as $businessId => $businessName)
                            <option value="{{ $businessId }}" @if (isset($area)){{ $businessId == $area->business_id ? 'selected' : '' }}@endif>
                            {{ $businessName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Details') }}</span>
                    </small>
                    <input type="text" name="description" id="description" class="form-control  {{ (($errors)->has('description')?'is-invalid':'') }}" value="{{ isset($area)?$area->description:'' }}" autocomplete="{{ old('description') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <small>
                    <span>{{ trans('messages.Departments') }}</span>
                </small>
                <div class="example">
                    @if ($departments->count()>0)
                        <div class="form-group m-0">
                            <div class="custom-controls-stacked">
                                @foreach ($departments as $department)
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                            name="departments[]"
                                            class="custom-control-input"
                                            value="{{ $department->id }}" @if(isset($area)&&$area->departments->contains($department->id)) checked @endif>
                                        <span class="custom-control-label"><span class="fw-bold">{{ $department->name}}.</span> {{ $department->description }}</span>
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
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.areas.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
            </div>
        </div>
    </div>


