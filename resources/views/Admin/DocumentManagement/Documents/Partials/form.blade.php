<div class="card">
    <div class="card-header bg-info-transparent p-2">
        <i class="fe fe-file-plus"></i>&nbsp;{{ trans('messages.Document.NewDocument') }}
    </div>
    <div class="card-body">

        @include('Admin.DocumentManagement.Documents.Partials.form-documents')

        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4><i class="fa-solid fa-link"></i>&nbsp;{{ trans('messages.LinkTo') }}:</h4>
            </div>
        </div>

        <div class="row mt-3">

            {{-- CUSTOMER --}}
            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group m-0">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Customer',null,['id'=>'customer_linked_at','checked'=>true]) !!}
                        <small> {{ trans('messages.Customer.Customers') }}</small>
                    </label>
                    {!! Form::select('customer_id', $customerSelect,null,[
                        'id'=>'customer_id',
                        'class'=>'form-control customer-show-search form-select customer ',
                        "style"=>"width: 100%;",
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>

            {{-- WORKER --}}
            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group m-0">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Worker',null,['id'=>'worker_linked_at']) !!}
                        <small> {{ trans('messages.Worker.Workers') }}</small>
                    </label>
                    {!! Form::select('worker_id', $workerSelect,null,[
                        'id'=>'worker_id',
                        'class'=>'form-control worker-show-search form-select worker ',
                        "style"=>"width: 100%;",
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>

            {{-- BUSINESS --}}
            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group m-0">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Business',null,['id'=>'business_linked_at']) !!}
                        <small> {{ trans('messages.Business.Business') }}</small>
                    </label>
                    {!! Form::select('business_id', $businessSelect,null,[
                        'id'=>'business_id',
                        'class'=>'form-control worker-show-search form-select business ',
                        "style"=>"width: 100%;",
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>

        </div>

        <div class="row mt-3">
            {{-- PROJECT --}}
            <div class="col-12 col-sm-4 col-md-4" id="project_id_col" style="display: none;">
                <div class="form-group m-0">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Project',null,['id'=>'project_linked_at']) !!}
                        <small> {{ trans('messages.Project.Projects') }}</small>
                    </label>
                    {!! Form::select('project_id', [],null,[
                        'id'=>'project_id',
                        'class'=>'form-control project-show-search form-select project ',
                        "style"=>"width: 100%;",
                        'placeholder'=>trans('messages.SelectProject'),
                    ]) !!}
                </div>
            </div>

            {{-- PROJECT CHORE --}}
            <div class="col-12 col-sm-4 col-md-4" id="project_chore_id_col" style="display: none;">
                <div class="form-group m-0">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\ProjectChore',null,['id'=>'project_chore_linked_at']) !!}
                        <small> {{ trans('messages.ProjectChore.ProjectChores') }}</small>
                    </label>
                    {!! Form::select('project_chore_id', [],null,[
                        'id'=>'project_chore_id',
                        'class'=>'form-control projectChore-show-search form-select projectChore ',
                        "style"=>"width: 100%;",
                        'placeholder'=>trans('messages.SelectProjectChore'),
                    ]) !!}
                </div>
            </div>

            {{-- OPPORTUNITY --}}
            <div class="col-12 col-sm-4 col-md-4" id="opportunity_id_col" style="display: none;">
                <div class="form-group m-0">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Opportunity',null,['id'=>'opportunity_linked_at']) !!}
                        <small> {{ trans('messages.Opportunity.Opportunity') }}</small>
                    </label>
                    {!! Form::select('opportunity_id', [],null,[
                        'id'=>'opportunity_id',
                        'class'=>'form-control opportunity-show-search form-select opportunity ',
                        "style"=>"width: 100%;",
                        'placeholder'=>trans('messages.SelectOpportunity'),
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <hr>
        </div>

        {{-- <div class="row mt-3"> --}}
            {{-- <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Customer',null,['checked'=>isset($document)?false:true]) !!}
                        <small> {{ trans('messages.Customer.Customers') }}</small>
                    </label>
                    {!! Form::select('customer_id', $customerSelect,null,[
                        'class'=>'form-control select2-show-search form-select',
                        "style"=>"width: 100%;",
                        'data-placeholder'=>trans('messages.All'),
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>


            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Business',null) !!}
                        <small> {{ trans('messages.Business.Businesses') }}</small>
                    </label>
                    {!! Form::select('business_id', $businessSelect,null,[
                        'class'=>'form-control select2-show-search form-select',
                        "style"=>"width: 100%;",
                        'data-placeholder'=>trans('messages.All'),
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>


            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Worker',null) !!}
                        <small> {{ trans('messages.Worker.Workers') }}</small>
                    </label>
                    {!! Form::select('worker_id', $workerSelect,null,[
                        'class'=>'form-control select2-show-search form-select',
                        "style"=>"width: 100%;",
                        'data-placeholder'=>trans('messages.All'),
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div> --}}


            {{-- <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Project',null) !!}
                        <small> {{ trans('messages.Project.Projects') }}</small>
                    </label>
                    {!! Form::select('project_id', $projectSelect,null,[
                        'class'=>'form-control select2-show-search form-select',
                        "style"=>"width: 100%;",
                        'data-placeholder'=>trans('messages.All'),
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>


            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\ProjectChore',null) !!}
                        <small> {{ trans('messages.ProjectChore.ProjectChores') }}</small>
                    </label>
                    {!! Form::select('project_chore_id', $projectChoreSelect,null,[
                        'class'=>'form-control select2-show-search form-select',
                        "style"=>"width: 100%;",
                        'data-placeholder'=>trans('messages.All'),
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div>


            <div class="col-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label class="form-label m-0">
                        {!! Form::radio('linked_at', 'App\Models\Opportunity',null) !!}
                        <small> {{ trans('messages.Opportunity.Opportunity') }}</small>
                    </label>
                    {!! Form::select('opportunity_id', $opportunitySelect,null,[
                        'class'=>'form-control select2-show-search form-select',
                        "style"=>"width: 100%;",
                        'data-placeholder'=>trans('messages.All'),
                        'placeholder'=>trans('messages.All'),
                    ]) !!}
                </div>
            </div> --}}
        {{-- </div> --}}
        @include('Admin.DocumentManagement.Partials.form-is-expense')
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-sm btn-outline-primary text-uppercase"><i class="fa fa-save"></i>&nbsp;&nbsp;{{ trans('messages.Save') }}</button>
                <a class="btn btn-sm btn-outline-default text-uppercase" href="{{ route('admin.documents.index') }}"><i class="fa fa-close"></i>&nbsp;&nbsp;{{ trans('messages.Cancel') }}</a>
            </div>
        </div>
    </div>
</div>

