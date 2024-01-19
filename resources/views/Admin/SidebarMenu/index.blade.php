@extends('layouts.admin.app')

@section('main_container')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">&nbsp;</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><small>Dashboard</small></a></li>
                    <li class="breadcrumb-item active"><small>{{ trans('messages.Favorites') }}</small></li>
                </ol>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col">
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <h1 class="page-title"><i class="fa-solid fa-grip-vertical"></i>&nbsp;{{ trans('messages.AddMenu') }}</h1>
                        </div>
                        <div class="card-body">

                            {{-- AÑADIR MENU --}}
                            <div class="row row-sm mb-3">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap table-bordered text-md-nowrap mb-0">
                                            <tbody>
                                                <tr class="bg-default">
                                                    <td class="py-1"><small class="fw-bold">{{ trans('messages.AddMenu') }}</small></td>
                                                    <td class="py-1"><small class="fw-bold">ICON</small></td>
                                                    <td class="py-1"><small class="fw-bold">{{ trans('messages.Order') }}</small></td>
                                                    <td class="py-1"></td>
                                                </tr>
                                                {!! Form::open(array('route'=>'admin.sidebarMenus.newMenuFather','method'=>'POST','name'=>'form_new_menu_father')) !!}
                                                @csrf
                                                    <tr>
                                                        </td>
                                                        <td class="py-1">
                                                            {!! Form::text('name', null, [
                                                                'class'=>'form-control form-control-sm ',
                                                            ]) !!}
                                                        </td>
                                                        <td class="py-1">
                                                            {!! Form::text('icon', null, [
                                                                'class'=>'form-control form-control-sm ',
                                                            ]) !!}
                                                        </td>
                                                        <td class="py-1">
                                                            {!! Form::text('order', $sidebarMenuFatherOrderMax, [
                                                                'class'=>'form-control form-control-sm ',
                                                            ]) !!}
                                                        </td>
                                                        <td class="py-1 text-end" style="width: 60px;">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-success"
                                                                data-bs-placement="top"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ trans('messages.New') }}">
                                                                <i class="fe fe-plus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                {!! Form::close() !!}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- AÑADIR SUBMENU --}}
                            <div class="row row-sm mb-3">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap table-bordered text-md-nowrap mb-0">
                                            <tbody>
                                                <tr class="bg-default">
                                                    <td class="py-1"><small class="fw-bold">{{ trans('messages.AddSubMenu') }}</small></td>
                                                    <td class="py-1"><small class="fw-bold">{{ trans('messages.MenuFather') }}</small></td>
                                                    <td class="py-1"></td>
                                                </tr>
                                                {!! Form::open(array('route'=>'admin.sidebarMenus.newMenuSubFather','method'=>'POST','name'=>'form_menu_new_sub_father')) !!}
                                                @csrf
                                                    <tr>
                                                        <td class="py-1">
                                                            {!! Form::text('name', null, [
                                                                'class'=>'form-control form-control-sm',
                                                            ]) !!}
                                                        </td>
                                                        <td class="py-1">
                                                            {!! Form::select('sidebar_menu_father_id', $sidebarMenuFatherSelect,null,[
                                                                'class'=>'form-control form-control-sm',
                                                            ]) !!}
                                                        </td>
                                                        <td class="py-1 text-end" style="width: 60px;">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-icon btn-success"
                                                                data-bs-placement="top"
                                                                data-bs-toggle="tooltip"
                                                                title="{{ trans('messages.New') }}">
                                                                <i class="fe fe-plus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                {!! Form::close() !!}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col">
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <h1 class="page-title"><i class="fa-solid fa-grip-vertical"></i>&nbsp;{{ trans('messages.EditMenu') }}</h1>
                        </div>
                        <div class="card-body">
                            {{-- EDITAR MENU --}}
                            <div class="row row-sm">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap table-bordered text-md-nowrap mb-0">
                                            <tbody>
                                                <tr class="bg-default">
                                                    <td class="py-1"><i class="fa-solid fa-eye"></i></td>
                                                    <td class="py-1"><small class="fw-bold">{{ trans('messages.Name') }}</small></td>
                                                    <td class="py-1"><small class="fw-bold">ICON</small></td>
                                                    <td class="py-1"><small class="fw-bold">{{ trans('messages.Order') }}</small></td>
                                                    <td class="py-1"></td>
                                                </tr>
                                                @foreach ($sidebarMenuFathers as $sidebarMenuFather)
                                                    {!! Form::model($sidebarMenuFather,['route'=>['admin.sidebarMenus.updateMenuFather',$sidebarMenuFather],'method'=>'put','name'=>'form_sidebar_menu_father_'.$sidebarMenuFather->id]) !!}
                                                    @csrf
                                                        <tr>
                                                            <td class="py-1 text-center" style="width: 20px;">
                                                                {{ Form::checkbox('active',1,null,['class'=>'m-2']) }}
                                                            </td>
                                                            <td class="py-1">
                                                                {!! Form::text('name', null, [
                                                                    'class'=>'form-control form-control-sm border-0 ',
                                                                ]) !!}
                                                            </td>
                                                            <td class="py-1">
                                                                {!! Form::text('icon', null, [
                                                                    'class'=>'form-control form-control-sm border-0 ',
                                                                ]) !!}
                                                            </td>
                                                            <td class="py-1">
                                                                {!! Form::text('order', null, [
                                                                    'class'=>'form-control form-control-sm border-0 ',
                                                                ]) !!}
                                                            </td>
                                                            <td class="py-1 text-end" style="width: 60px;">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-icon btn-success"
                                                                    data-bs-placement="top"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ trans('messages.Save') }}">
                                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                                </button>
                                                                <a class="modal-effect btn text-danger btn-sm"
                                                                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                                    data-name="{{ $sidebarMenuFather->name }}"
                                                                    data-route="{{ route('admin.sidebarMenus.destroyMenuFather',$sidebarMenuFather->id) }}">
                                                                    <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                                        <i class="fe fe-trash"></i>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    {!! Form::close() !!}
                                                    @if ($sidebarMenuFather->sidebarMenuSubFathers->count()>0)
                                                        @foreach ($sidebarMenuFather->sidebarMenuSubFathers as $sidebarMenuSubFather)
                                                            {!! Form::model($sidebarMenuSubFather,['route'=>['admin.sidebarMenus.updateMenuSubFather',$sidebarMenuSubFather],'method'=>'put','name'=>'form_sidebar_update_menu_sub_father_'.$sidebarMenuSubFather->id]) !!}
                                                            @csrf
                                                                <tr>
                                                                    <td class="p-0"></td>
                                                                    <td class="p-0" colspan="3">
                                                                        <table class="table text-nowrap table-bordered text-md-nowrap mb-0 bg-none">
                                                                            <tr>
                                                                                <td class="py-1 text-center" style="width: 20px;">
                                                                                    {{ Form::checkbox('active',1,null,['class'=>'m-2']) }}
                                                                                </td>
                                                                                <td class="py-1">
                                                                                    {!! Form::text('name', null, [
                                                                                        'class'=>'form-control form-control-sm border-0 ',
                                                                                    ]) !!}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td class="py-1 " style="width: 60px;">
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-icon btn-success"
                                                                            data-bs-placement="top"
                                                                            data-bs-toggle="tooltip"
                                                                            title="{{ trans('messages.Save') }}">
                                                                            <i class="fa-solid fa-floppy-disk"></i>
                                                                        </button>
                                                                        <a class="modal-effect btn text-danger btn-sm"
                                                                            data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                                            data-name="{{ $sidebarMenuSubFather->name }}"
                                                                            data-route="{{ route('admin.sidebarMenus.destroyMenuSubFather',$sidebarMenuSubFather->id) }}">
                                                                            <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                                                <i class="fe fe-trash"></i>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            {!! Form::close() !!}
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        {{-- ITEMS DEL MENU --}}
        <div class="row row-sm">
            <div class="col">
                    <div class="card">
                        <div class="card-header bg-info-transparent p-2">
                            <h1 class="page-title"><i class="fa-solid fa-grip-vertical"></i>&nbsp;{{ trans('messages.MenuItems') }}</h1>
                        </div>
                        <div class="card-body">
                            <div class="row row-sm">
                                <div class="col">
                                    @foreach ($sidebarMenuFathers as $sidebarMenuFather)
                                        <div class="accordion" id="sidebarMenuFather{{ $sidebarMenuFather->id }}">
                                            <div class="accordion-item mb-2">
                                                <h2 class="accordion-header bg-default" id="heading{{ $sidebarMenuFather->id }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $sidebarMenuFather->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                                        <span class="fw-bold">
                                                            <i class="{{ $sidebarMenuFather->icon }}"></i>&nbsp;
                                                            &nbsp;
                                                            {{ $sidebarMenuFather->name }}
                                                        </span>
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $sidebarMenuFather->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $sidebarMenuFather->id }}" data-bs-parent="#sidebarMenuFather{{ $sidebarMenuFather->id }}">
                                                    <div class="accordion-body">
                                                        <div class="table-responsive">
                                                            <table class="table text-nowrap table-bordered text-md-nowrap mb-0">
                                                                <tbody>
                                                                    <tr class="bg-default">
                                                                        <td class="py-1 text-center"><i class="fa-solid fa-eye"></i></td>
                                                                        <td class="py-1"><small class="fw-bold">{{ trans('messages.Name') }}&nbsp;{{ trans('messages.NewItem') }}</small></td>
                                                                        <td class="py-1"><small>{{ trans('messages.Route') }}</small></td>
                                                                        <td class="py-1"><small>{{ trans('messages.Permission.Permission') }}</small></td>
                                                                        <td class="py-1"></td>
                                                                    </tr>
                                                                    {!! Form::open(array('route'=>'admin.sidebarMenus.newMenuItem','method'=>'POST','name'=>'form_menu_new_father_{{ $sidebarMenuFather->id }}')) !!}
                                                                    @csrf
                                                                        <input type="hidden" name="sidebar_menu_father_id" value="{{ $sidebarMenuFather->id }}">
                                                                        <tr>
                                                                            <td class="py-1" style="width: 20px;"></td>
                                                                            <td class="py-1">
                                                                                {!! Form::text('name', null, [
                                                                                    'class'=>'form-control form-control-sm ',
                                                                                ]) !!}
                                                                            </td>
                                                                            <td class="py-1">
                                                                                {!! Form::text('route', null, [
                                                                                    'class'=>'form-control form-control-sm ',
                                                                                ]) !!}
                                                                            <td class="py-1">
                                                                                {!! Form::text('permission', null, [
                                                                                    'class'=>'form-control form-control-sm ',
                                                                                ]) !!}
                                                                            </td>
                                                                            <td class="py-1 text-end" style="width: 60px;">
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-icon btn-success"
                                                                                    data-bs-placement="top"
                                                                                    data-bs-toggle="tooltip"
                                                                                    title="{{ trans('messages.New') }}">
                                                                                    <i class="fe fe-plus"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    {!! Form::close() !!}
                                                                    {{-- {{ dd($sidebarMenuFather->sidebarMenus) }} --}}
                                                                    @foreach ($sidebarMenuFather->sidebarMenus as $sidebarMenu)
                                                                        {!! Form::model($sidebarMenu,['route'=>['admin.sidebarMenus.updateItem',$sidebarMenu],'method'=>'put','name'=>'form_sidebar_menu_'.$sidebarMenu->id]) !!}
                                                                        @csrf
                                                                            <tr>
                                                                                <td class="py-1" style="width: 20px;">
                                                                                    {{ Form::checkbox('active',1,null,['class'=>'m-2']) }}
                                                                                </td>
                                                                                <td class="py-1">
                                                                                    {!! Form::text('name', null, [
                                                                                        'class'=>'form-control form-control-sm border-0 ',
                                                                                    ]) !!}
                                                                                </td>
                                                                                <td class="py-1">
                                                                                    {!! Form::text('route', null, [
                                                                                        'class'=>'form-control form-control-sm border-0 ',
                                                                                    ]) !!}
                                                                                <td class="py-1">
                                                                                    {!! Form::text('permission', null, [
                                                                                        'class'=>'form-control form-control-sm border-0 ',
                                                                                    ]) !!}
                                                                                </td>
                                                                                <td class="py-1" style="width: 60px;" class="text-end">
                                                                                    <button type="submit"
                                                                                        class="btn btn-sm btn-icon btn-success"
                                                                                        data-bs-placement="top"
                                                                                        data-bs-toggle="tooltip"
                                                                                        title="{{ trans('messages.Save') }}">
                                                                                        <i class="fa-solid fa-floppy-disk"></i>
                                                                                    </button>
                                                                                    <a class="modal-effect btn text-danger btn-sm"
                                                                                        data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                                                        data-name="{{ $sidebarMenu->name }}"
                                                                                        data-route="{{ route('admin.sidebarMenus.destroyItem',$sidebarMenu->id) }}">
                                                                                        <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                                                            <i class="fe fe-trash"></i>
                                                                                        </div>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        {!! Form::close() !!}
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        @if ($sidebarMenuFather->sidebarMenuSubFathers->count()>0)
                                                            @foreach ($sidebarMenuFather->sidebarMenuSubFathers as $sidebarMenuSubFather)
                                                                <div class="accordion mt-3" id="sidebarMenuSubFather{{ $sidebarMenuSubFather->id }}">
                                                                    <div class="accordion-item mb-2">
                                                                        <h2 class="accordion-header" id="headingMenuSubFather{{ $sidebarMenuFather->id }}">
                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMenuSubFather{{ $sidebarMenuSubFather->id }}" aria-expanded="false" aria-controls="collapseMenuSubFather{{ $sidebarMenuSubFather->id }}">
                                                                                <span class="fw-bold">
                                                                                    <i class="fa-solid fa-angles-right"></i>&nbsp;
                                                                                    &nbsp;
                                                                                    {{ $sidebarMenuSubFather->name }}
                                                                                </span>
                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapseMenuSubFather{{ $sidebarMenuSubFather->id }}" class="accordion-collapse collapse" aria-labelledby="headingMenuSubFather{{ $sidebarMenuSubFather->id }}" data-bs-parent="#sidebarMenuSubFather{{ $sidebarMenuFather->id }}">
                                                                            <div class="accordion-body">
                                                                                <div class="table-responsive">
                                                                                    {{-- <form id="formDeleteMenuSubFather" method="POST" action="{{ route('admin.sidebarMenus.destroyMenuSubFather',$sidebarMenuSubFather->id ) }}">
                                                                                        @csrf @method('DELETE')
                                                                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-block">
                                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                                            {{ trans('messages.Delete') }}&nbsp; {{ trans('messages.SubMenu') }}
                                                                                        </button>
                                                                                    </form> --}}

                                                                                    <table class="table text-nowrap table-bordered text-md-nowrap mb-0">
                                                                                        <tbody>
                                                                                            <tr class="bg-default">
                                                                                                <td class="py-1"><i class="fa-solid fa-eye"></i></td>
                                                                                                <td class="py-1"><small class="fw-bold">{{ trans('messages.Name') }}&nbsp;{{ trans('messages.NewItem') }}</small></td>
                                                                                                <td class="py-1"><small>{{ trans('messages.Route') }}</small></td>
                                                                                                <td class="py-1"><small>{{ trans('messages.Permission.Permission') }}</small></td>
                                                                                                <td class="py-1"></td>
                                                                                            </tr>
                                                                                            {!! Form::open(array('route'=>'admin.sidebarMenus.newMenuItem','method'=>'POST','name'=>'form_menu_new_father_{{ $sidebarMenuFather->id }}')) !!}
                                                                                            @csrf
                                                                                                <input type="hidden" name="sidebar_menu_sub_father_id" value="{{ $sidebarMenuSubFather->id }}">
                                                                                                <tr>
                                                                                                    <td class="py-1" style="width: 20px;">#</td>
                                                                                                    <td class="py-1">
                                                                                                        {!! Form::text('name', null, [
                                                                                                            'class'=>'form-control form-control-sm ',
                                                                                                        ]) !!}
                                                                                                    </td>
                                                                                                    <td class="py-1">
                                                                                                        {!! Form::text('route', null, [
                                                                                                            'class'=>'form-control form-control-sm ',
                                                                                                        ]) !!}
                                                                                                    </td>
                                                                                                    <td class="py-1">
                                                                                                        {!! Form::text('permission', null, [
                                                                                                            'class'=>'form-control form-control-sm ',
                                                                                                        ]) !!}
                                                                                                    </td>
                                                                                                    <td class="py-1 text-end" style="width: 60px;">
                                                                                                        <button type="submit"
                                                                                                            class="btn btn-sm btn-icon btn-success"
                                                                                                            data-bs-placement="top"
                                                                                                            data-bs-toggle="tooltip"
                                                                                                            title="{{ trans('messages.New') }}">
                                                                                                            <i class="fe fe-plus"></i>&nbsp;
                                                                                                        </button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            {!! Form::close() !!}
                                                                                            @if ($sidebarMenuSubFather!=null)
                                                                                                @foreach ($sidebarMenuSubFather->sidebarMenus as $sidebarSubMenu)
                                                                                                    {!! Form::model($sidebarSubMenu,['route'=>['admin.sidebarMenus.updateItem',$sidebarSubMenu],'method'=>'put','name'=>'form_sidebar_sub_menu_'.$sidebarSubMenu->id]) !!}
                                                                                                    @csrf
                                                                                                        <tr>
                                                                                                            <td class="py-1" style="width: 20px;">
                                                                                                                {{ Form::checkbox('active',1,null,['class'=>'m-2']) }}
                                                                                                            </td>
                                                                                                            <td class="py-1">
                                                                                                                {!! Form::text('name', null, [
                                                                                                                    'class'=>'form-control form-control-sm border-0 '.(($errors)->has('name')?'is-invalid':''),
                                                                                                                    'value'=>old('name'),
                                                                                                                ]) !!}
                                                                                                            </td>
                                                                                                            <td class="py-1">
                                                                                                                {!! Form::text('route', null, [
                                                                                                                    'class'=>'form-control form-control-sm border-0 '.(($errors)->has('route')?'is-invalid':''),
                                                                                                                    'value'=>old('route'),
                                                                                                                ]) !!}
                                                                                                            <td class="py-1">
                                                                                                                {!! Form::text('permission', null, [
                                                                                                                    'class'=>'form-control form-control-sm border-0 '.(($errors)->has('permission')?'is-invalid':''),
                                                                                                                    'value'=>old('permission'),
                                                                                                                ]) !!}
                                                                                                            </td>
                                                                                                            <td class="py-1" style="width: 60px;" class="text-end">
                                                                                                                <button type="submit"
                                                                                                                    class="btn btn-sm btn-icon btn-success"
                                                                                                                    data-bs-placement="top"
                                                                                                                    data-bs-toggle="tooltip"
                                                                                                                    title="{{ trans('messages.Save') }}">
                                                                                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                                                                                </button>
                                                                                                                <a class="modal-effect btn text-danger btn-sm"
                                                                                                                    data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modalEliminar"
                                                                                                                    data-name="{{ $sidebarSubMenu->name }}"
                                                                                                                    data-route="{{ route('admin.sidebarMenus.destroyItem',$sidebarSubMenu->id) }}">
                                                                                                                    <div data-bs-placement="top" data-bs-toggle="tooltip" title="{{ trans('messages.Delete') }}">
                                                                                                                        <i class="fe fe-trash"></i>
                                                                                                                    </div>
                                                                                                                </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    {!! Form::close() !!}
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @can('countries.destroy')
        @include('layouts.admin.modal.delete-reg-html')
    @endcan
@endsection

@section('sectiontitle') {{ trans('messages.SidebarMenu.SidebarMenus') }} @endsection

@section('page_css') @endsection

@section('scripts_js')
    @include('layouts.admin.scripts_js.datatable')
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#countries_table").DataTable({
                "columnDefs": [
                    { orderable: false, targets: [5] },
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 1, targets: 5 },
                ],
                "order": [[1, 'asc']],
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ ",
                    "zeroRecords": "No se han encontrado registros",
                    "info": "P&aacute;gina _PAGE_ de _PAGES_",
                    "infoEmpty": "Mostrando 0 to 0 of 0 registros",
                    "emptyTable": "No hay datos en la tabla",
                    "infoEmpty": "Sin registros",
                    "loadingRecords": "Cargando...",
                    "infoFiltered": "(filtrados de _MAX_ registros)",
                    "processing": "Procesando...",
                    "search": "Busc: ",
                    "thousands": ".",
                    "decimal": ",",
                    "paginate": {
                        "first": "Primero",
                        "last": "&Uacute;ltimo",
                        "next": ">",
                        "previous": "<"
                    }
                },
                "buttons": {
                    "dom": {
                        "button": {
                            "className": "btn btn-outline-primary btn-sm"
                        }
                    },
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                }
            }).buttons().container().appendTo('#countries_table_wrapper .col-md-6:eq(0)');
        });
    </script>
     @can('countries.destroy')
        @include('layouts.admin.modal.delete-reg-scritp')
    @endcan
@endsection
