<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('name')?'class="text-danger"':'' }}>{{ trans('messages.Name') }}</span>
            </small>
            {!! Form::text('name', null, array(
            'class'=>'form-control '.(($errors)->has('name')?'is-invalid':''),
            'value'=>old('name'),
            'autocomplete'=>'name',
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
            {!! Form::text('description', null, [
                'class'=>'form-control '.(($errors)->has('description')?'is-invalid':''),
                'value'=>old('description'),
                'maxlength'=>500,
            ]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <small>
                <span {{ ($errors)->has('tags')?'class="text-danger"':'' }}>{{ trans('messages.Tags') }} <small>({{ trans('messages.SeparateByCommas') }})</small></span>
            </small>
            {!! Form::text('tags', null, [
                'class'=>'form-control '.(($errors)->has('tags')?'is-invalid':''),
                'value'=>old('tags'),
                'maxlength'=>255,
                'placeholder'=>'',
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
                'class'=>'form-control form-select',
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



