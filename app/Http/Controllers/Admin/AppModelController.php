<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AppModelController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:appModels.show|appModels.index|appModels.create|appModels.edit|appModels.destroy',['only'=>['index']]);
        $this->middleware('permission:appModels.create', ['only'=>['store']]);
        $this->middleware('permission:appModels.edit', ['only'=>['edit', 'update','setUser','storePermission','updatePermission','deletePermission']]);
        $this->middleware('permission:appModels.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $appModels = AppModel::all();
        return view('landlord.AppModels.index', compact('appModels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      =>'required|string|max:125|unique:app_models,name',
            'namespace' =>'required|string|max:125|unique:app_models,namespace',
        ]);

        $inputs['name'] = $request->name;
        $inputs['namespace'] = $request->description;

        $logVars=logVars();
        $model = trans('messages.AppModel.AppModel');
        $controllerFunction = 'AppModelController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.appModels.edit';

        try {
            $appModel = AppModel::create($inputs);

            Log::info("AppModel Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$appModel,'logVars'=>$logVars));
            return redirect()->route($route,$appModel)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.appModels.edit',$appModel)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function edit(AppModel $appModel):View
    {
        return view('landlord.AppModels.edit',compact('appModel'));
    }

    public function update(Request $request, AppModel $appModel)
    {
        $request->validate([
            'name'      =>'required|string|max:125|unique:app_models,name,'.$appModel->id,
            'namespace' =>'required|string|max:125|unique:app_models,namespace,'.$appModel->id,
        ]);

        $inputs['name'] = $request->name;
        $inputs['namespace'] = $request->description;

        $logVars=logVars();
        $model = trans('messages.AppModel.AppModel');
        $controllerFunction = 'AppModelController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.appModels.edit';

        try {
            $appModel->update($inputs);

            Log::info("AppModel Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$appModel,'logVars'=>$logVars));
            return redirect()->route($route,$appModel)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.appModels.edit',$appModel)->with('warning',trans('messages.InfoSuccess.UpdatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request, AppModel $appModel)
    {
        $logVars=logVars();
        $model = trans('messages.AppModel.AppModel');
        $controllerFunction = 'AppModelController.storePermission';
        $route = $request->ubi?base64_decode($request->ubi):'admin.appModels.index';

        try {

            $permission = $appModel->permission;
            $appPermission = $appModel->appPermission;

            $appPermission->delete();
            $permission->delete();
            $appModel->delete();

            Log::info("AppModel destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$appModel,'logVars'=>$logVars));
            return redirect()->route($route,$appModel)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.appModels.index')->with('warning',trans('messages.InfoSuccess.DeletedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function storePermission(Request $request, AppModel $appModel)
    {
        $request->validate([
            'name'=>'required|string|max:125|unique:app_permissions,name',
            'description'=>'required|string|max:125|unique:app_permissions,description',
        ]);
        $inputs['name'] = $request->name;
        $inputs['description'] = $request->description;
        $inputs['app_model_id'] = $appModel->id;

        $logVars=logVars();
        $model = trans('messages.AppModel.AppModel');
        $controllerFunction = 'AppModelController.storePermission';
        $route = $request->ubi?base64_decode($request->ubi):'admin.appModels.edit';

        try {
            $permission = Permission::create($inputs)->assignRole('Administrador');
            $inputs['permission_id'] = $permission->id;
            // AppPermission::create($inputs);

            Log::info("AppPermision Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$appModel,'logVars'=>$logVars));
            return redirect()->route($route,$appModel)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.appModels.edit',$appModel)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    // public function updatePermission(Request $request, AppPermission $appPermission)
    // {
    //     $request->validate([
    //         'name'=>'required|string|max:125|unique:app_permissions,name,'.$appPermission->id,
    //         'description'=>'required|string|max:125|unique:app_permissions,description,'.$appPermission->id,
    //     ]);

    //     $inputs['name'] = $request->name;
    //     $inputs['description'] = $request->description;

    //     $logVars=logVars();
    //     $model = trans('messages.AppModel.AppModel');
    //     $controllerFunction = 'AppModelController.storePermission';
    //     $route = $request->ubi?base64_decode($request->ubi):'admin.appModels.edit';

    //     try {
    //         $appModel = $appPermission->appModel;
    //         $permission = $appPermission->permission;
    //         $permission->update($inputs);
    //         $appPermission->update($inputs);

    //         Log::info("BankAccount Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$appModel,'logVars'=>$logVars));
    //         return redirect()->route($route,$appModel)->with('info',trans('messages.InfoSuccess.Updated'));
    //     } catch (RouteNotFoundException $re) {
    //         createErrorExceptionLog($re,$controllerFunction);
    //         return redirect()->route('admin.appModels.edit',$appModel)->with('warning',trans('messages.InfoSuccess.UpdatedButError'));
    //     } catch (\Throwable $th) {
    //         createErrorExceptionLog($th,$controllerFunction);
    //         return back()
    //             ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
    //     }
    // }

    // public function deletePermission(Request $request, AppPermission $appPermission)
    // {
    //     $logVars=logVars();
    //     $model = trans('messages.AppModel.AppModel');
    //     $controllerFunction = 'AppModelController.storePermission';
    //     $route = $request->ubi?base64_decode($request->ubi):'admin.appModels.edit';

    //     try {
    //         $appModel = $appPermission->appModel;
    //         $permission = $appPermission->permission;

    //         $appPermission->delete();
    //         $permission->delete();

    //         Log::info("Permission destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$appModel,'logVars'=>$logVars));
    //         return redirect()->route($route,$appModel)->with('info',trans('messages.InfoSuccess.Deleted'));
    //     } catch (RouteNotFoundException $re) {
    //         createErrorExceptionLog($re,$controllerFunction);
    //         return redirect()->route('admin.appModels.edit',$appModel)->with('warning',trans('messages.InfoSuccess.DeletedButError'));
    //     } catch (\Throwable $th) {
    //         createErrorExceptionLog($th,$controllerFunction);
    //         return back()
    //             ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
    //     }
    // }
}
