<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:roles.index|roles.create|roles.edit|roles.destroy',['only'=>['index']]);
        $this->middleware('permission:roles.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:roles.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:roles.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $roles = Role::all();
        return view('common.Roles.index', compact('roles'));
    }

    public function create():View
    {
        $showAll = true;

        $permissions = Permission::all();
        $permissionModels = $permissions->unique('menu')->pluck('menu','model');

        return view('common.Roles.create', compact(
            'permissions',
            'permissionModels',
            'showAll',
        ));
    }

    public function store(Request $request):RedirectResponse
    {
        $this->validate($request,[
            'name'=>'required|unique:roles',
        ]);

        $logVars=logVars();
        $model = trans('messages.Role.Role');
        $controllerFunction = 'RoleController.store';

        try {
            $role = Role::create($request->all());

            try {
                $role->permissions()->sync($request->permissions);
            } catch (\Throwable $th) {
                $role->delete();
                throw new Exception(trans("messages.InfoError.ToAssignPermissions",['model'=>$model]));
            }
            Log::info("Role Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$role,'logVars'=>$logVars));
            return redirect()->route('admin.roles.index')->with('info',trans('messages.InfoSuccess.Created'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, Role $role):View
    {
        // $roleUsers = User::whereHas('roles', function ($query) {
        //     $query->where('name', 'Administrador');
        // })->get();

        $showAll = $request->showAll?$request->showAll:'false';

        // if ($request->showAll){
        //     $showAll = $request->showAll;
        // }

        $permissions = Permission::all();
        $appModels = AppModel::orderBy('name')->with('permissions')->get();
        $permissionModels = $permissions->unique('menu')->pluck('menu','model');

        return view('common.Roles.edit', compact(
            'appModels',
            'role',
            'permissions',
            'permissionModels',
            'showAll'
        ));
    }

    public function update(Request $request,Role $role):RedirectResponse
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $logVars=logVars();
        $model = trans('messages.Role.Role');
        $controllerFunction = 'RoleController.update';

        try {
            $role->update($request->all());

            try {
                $role->permissions()->sync($request->permissions);
            } catch (\Throwable $th) {
                throw new Exception(trans("messages.InfoError.ToAssignPermissions",['model'=>$model]));
            }

            Log::info("Role Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$role,'logVars'=>$logVars));
            return redirect()->route('admin.roles.edit',$role)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return redirect()->route('admin.roles.index')
                ->with('error',trans('messages.InfoError.Update',['model'=>$model]));
        }
    }

    public function destroy($id)//:RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Role.Role');
        $controllerFunction = 'RoleController.destroy';

        try {
            $role = Role::find($id);
            if ($role->name == 'Administrador'){
                return back()->with(trans('error','messages.InfoError.CanNotBeDeleted'));
            }

            DB::table('roles')->where('id',$id)->delete();

            Log::info("Role Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$role,'logVars'=>$logVars));
            return redirect()->route('admin.roles.index')->with('info',trans('messages.InfoSuccess.Deleted'));;
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
