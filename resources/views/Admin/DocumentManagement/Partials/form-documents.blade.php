<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('document_name')?'class="text-danger"':'' }}>{{ trans('messages.FileName') }}</span>
            </small>
            {!! Form::text('document_name', null, array(
            'class'=>'form-control '.(($errors)->has('document_name')?'is-invalid':''),
            'value'=>old('document_name'),
            'id'=>'document_name',
            'autocomplete'=>'document_name',
            'maxlength'=>191,
            'required'
        )) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('description')?'class="text-danger"':'' }}>{{ trans('messages.Description') }}</span>
            </small>
            {!! Form::text('document_description', null, [
                'class'=>'form-control '.(($errors)->has('description')?'is-invalid':''),
                'value'=>old('description'),
                'maxlength'=>500,
            ]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-4">
        <small>
            <span {{ ($errors)->has('document_type_id')?'class="text-danger"':'' }}> {{ trans('messages.DocumentType.DocumentType') }} </span>
        </small>
        <div class="form-group">
            {!! Form::select('document_type_id', $documentTypeSelect,null,[
                'class'=>'form-control select2-show-search form-select',
                'required'
            ]) !!}
        </div>
    </div>
    <div class="col-12 col-sm-8">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('document')?'class="text-danger"':'' }}> {{ trans('messages.Document.Document') }} </span>
            </small>
            <input name="document" class="form-control" type="file" accept="application/pdf,image/jpeg,image/png,image/jpg,image/svg" required>
        </div>
    </div>
</div>



