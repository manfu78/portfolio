<div class="row">
    <div class="col-auto">
        <div class="custom-controls-stacked">
            <label class="custom-control custom-checkbox-md">
                <input type="checkbox" class="custom-control-input" name="is_expense" value="1">
                <span class="custom-control-label">{{ trans('messages.IsExpense') }}?</span>
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-auto">
         <div class="form-group">
            <label class="form-label m-0">
                <small>Total</small>
            </label>
            {!! Form::number('total', null, [
                'class'=>'form-control text-end '.(($errors)->has('total')?'is-invalid':''),
                'value'=>old('total'),
                'step'=>'0.01',
                'min'=>'0',
            ]) !!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
           <label class="form-label m-0">
               <small>{{ trans('messages.CoinType.CoinType') }}</small>
           </label>
           {!! Form::select('coin_type_id', $coinTypeSelect,null,[
                'class'=>'form-control select2 form-select',
                'style'=>'width: 100px;',
            ]) !!}
       </div>
   </div>
</div>
