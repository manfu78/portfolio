
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label class="form-label m-0">
                        <small> {{ trans('messages.Worker.Worker') }}</small>
                    </label>
                    <select name="user_id" id="user_id"
                        class="form-control worker-show-search form-select worker  {{ (($errors)->has('user_id')?'is-invalid':'') }}"
                        data-bs-placeholder="{{ "Select ".trans('messages.SelectWorker') }}"
                        style="width: 100%;">
                        @foreach($userWorkerSelect as $userWorkerId => $userWorkerName)
                            <option value="{{ $userWorkerId }}" @if (isset($notification)){{ $userWorkerId == $notification->user_id ? 'selected' : '' }}@endif>
                            {{ $userWorkerName }}
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
                        <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Notification.Notification') }}</span>
                        <span class="text-red">*</span>
                    </small>
                    <input type="text" name="name" id="name"
                    class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}"
                    value="{{ isset($notification)?$notification->name:'' }}"
                    autocomplete="name"
                    maxlength="255"
                    required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('url')?'class="text-danger"':'' }}>URL</span>
                    </small>
                    <input type="text" name="url" id="url"
                    class="form-control  {{ (($errors)->has('url')?'is-invalid':'') }}"
                    value="{{ isset($notification)?$notification->url:'' }}"
                    autocomplete="url"
                    maxlength="255">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <small>
                        <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Description') }}</span>
                    </small>
                    <textarea name="description" id="description"
                        class="form-control {{ (($errors)->has('description')?'is-invalid':'') }}"
                        rows="4">{{ isset($notification)?$notification->description:'' }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase submit-prevent-button"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.notifications.index') }}"><i class="fa fa-reply"></i>&nbsp;&nbsp;{{ trans('messages.GoBack') }}</a>
            </div>
        </div>
    </div>


