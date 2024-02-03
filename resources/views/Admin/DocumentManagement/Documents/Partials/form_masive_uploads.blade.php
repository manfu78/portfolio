<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group m-0">
            <small>{{ trans('messages.Date') }}</small>
            <input type="date" name="date" value="{{ date('Y-m-d',strtotime(now())) }}" class="form-control" required>
        </div>
    </div>
    <div class="col-12 col-sm-4">
        <small>
            <span {{ ($errors)->has('document_type_id')?'class="text-danger"':'' }}> {{ trans('messages.DocumentType.DocumentType') }} </span>
        </small>
        <div class="form-group">
            <select name="document_type_id" class="form-control select2-show-search form-select" required>
                @foreach($documentTypeSelect as $documentTypeId => $documentTypeName)
                    <option value="{{ $documentTypeId }}">
                        {{ $documentTypeName }}
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
                <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
            </small>
            <input type="text" name="name" class="form-control {{ (($errors)->has('name')?'is-invalid':'') }}" value="{{ old('name') }}" autocomplete="name" maxlength="191" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Description') }}</span>
            </small>
            <input type="textarea" name="description" class="form-control {{ (($errors)->has('description')?'is-invalid':'') }}" value="{{ old('description') }}" autocomplete="description" maxlength="500" rows="4">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group mb-1">
            <small>
                <span {{ ($errors)->has('tags')?'class="text-danger"':'' }}> {{ trans('messages.Tags') }}&nbsp;({{ trans('messages.SeparateByCommas') }})</span>
            </small>
            <div class="form-control">
                <input type="text" name="tags" data-role="tagsinput" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
