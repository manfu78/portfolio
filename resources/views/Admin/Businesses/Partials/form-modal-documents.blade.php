<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
            </small>
         <input type="text" name="name"
            class="form-control  {{ (($errors)->has('name')?'is-invalid':'') }}"
            value=""
            autocomplete="name"
            maxlength="191"
            required>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('date')?'class="text-danger"':'' }}>{{ trans('messages.Date') }}</span>
            </small>
         <input type="date" name="date"
            class="form-control  {{ (($errors)->has('date')?'is-invalid':'') }}"
            value="{{ date('Y-m-d',strtotime(now())) }}"
            required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Description') }}</span>
            </small>
            <input type="textarea" name="description"
                class="form-control  {{ (($errors)->has('description')?'is-invalid':'') }}"
                value="{{ isset($business)?$business->description:old('description') }}"
                maxlength="500"
                rows="3">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('tags')?'class="text-danger"':'' }}>{{ trans('messages.Tags') }} <small>({{ trans('messages.SeparateByCommas') }})</small></span>
            </small>
            <input type="text" name="tags"
                class="form-control  {{ (($errors)->has('tags')?'is-invalid':'') }}"
                value=""
                autocomplete="tags"
                maxlength="191">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-4">
        <small>
            <span {{ ($errors)->has('document_type_id')?'class="text-danger"':'' }}> {{ trans('messages.DocumentType.DocumentType') }} </span>
        </small>
        <div class="form-group">
            <select name="document_type_id" class="form-control documentSelect2 form-select {{ (($errors)->has('document_type_id')?'is-invalid':'') }}" data-bs-placeholder="{{ "Select ".trans('messages.DocumentType.DocumentType') }}" required>
                @foreach($documentTypeSelect as $documentTypeId => $documentTypeName)
                    <option value="{{ $documentTypeId }}">
                        {{ $documentTypeName }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-8">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('document')?'class="text-danger"':'' }}> {{ trans('messages.Document.Document') }} </span>
            </small>
            <input name="document" class="form-control" type="file" required>
        </div>
    </div>
</div>



