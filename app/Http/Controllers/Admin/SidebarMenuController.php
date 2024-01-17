<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SidebarMenuFather;
use App\Models\SidebarMenuItem;
use App\Models\SidebarMenuSubFather;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class SidebarMenuController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:sidebarMenus.show|sidebarMenus.index|sidebarMenus.create|sidebarMenus.edit|sidebarMenus.destroy',['only'=>['index','show']]);
        $this->middleware('permission:sidebarMenus.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:sidebarMenus.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:sidebarMenus.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $sidebarMenuFathers = SidebarMenuFather::orderBy('order')
            ->get();

        $sidebarMenuFathersSelect = $sidebarMenuFathers->pluck('name','id');
        $sidebarMenuFatherSelect = sidebarMenuFatherSelect();
        $sidebarMenuFatherOrderMax =( (SidebarMenuFather::max('order')??0))+1;

        return view('tenancy.SidebarMenuItem.index', compact(
            'sidebarMenuFathers',
            'sidebarMenuFathersSelect',
            'sidebarMenuFatherOrderMax',
            'sidebarMenuFatherSelect',
        ));
    }

    public function newMenuItem(Request $request):RedirectResponse
    {
        $rules = [
            'name'                      => 'required|string|max:191|unique:sidebar_menus,name',
            'route'                     => 'required|string|max:191|unique:sidebar_menus,name',
            'permission'                => 'required|string|max:191',
            'sidebar_menu_father_id'    => 'required_without:sidebar_menu_sub_father_id|exists:sidebar_menu_fathers,id',
            'sidebar_menu_sub_father_id'=> 'required_without:sidebar_menu_father_id|exists:sidebar_menu_sub_fathers,id',
        ];

        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.newMenuItem';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $this->validate($request, $rules);

            $inputs = $request->all();

            $sidebarMenuItem = SidebarMenuItem::create($inputs);

            Log::info("Menu NewItem. ".trans('messages.InfoSuccess.Created'),array('context'=>$sidebarMenuItem,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));

        } catch (ValidationException $ve) {
            return redirect()->route('admin.sidebarMenus.index')->with('error', $ve->getMessage());
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function newMenuFather(Request $request):RedirectResponse
    {

        $sidebarMenuFatherOrderMax =( (SidebarMenuFather::max('order')??0))+1;

        $rules = [
            'name'  => 'required|string|max:191|unique:sidebar_menu_fathers,name',
            'icon'  => 'required|string|max:191',
            'order' => 'nullable|numeric|min:1|max:'.$sidebarMenuFatherOrderMax,
        ];

        // $customMessages = [
        //     'required' => 'El campo :attribute es requerido.'
        // ];
        // $this->validate($request, $rules, $customMessages);

        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.newMenuFather';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $this->validate($request, $rules);

            $inputs = $request->all();


            if (!$request->order) {
                $inputs['order'] = $sidebarMenuFatherOrderMax;
            }

            $sidebarMenuFathers = SidebarMenuFather::orderBy('order')->get();
            $count = 1;
            foreach ($sidebarMenuFathers as $sidebarMenuFather) {
                if ($inputs['order']==$count) {
                    $count = $count+1;
                }
                $sidebarMenuFather->update(['order'=>$count]);
                $count = $count+1;
            }

            $sidebarMenuFather = SidebarMenuFather::create($inputs);

            Log::info("Menu New. ".trans('messages.InfoSuccess.Created'),array('context'=>$sidebarMenuFather,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));

        } catch (ValidationException $ve) {
            return redirect()->route('admin.sidebarMenus.index')->with('error', $ve->getMessage());
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function newMenuSubFather(Request $request):RedirectResponse
    {
        $rules = [
            'name'  => 'required|string|max:191|unique:sidebar_menus,name',
            'sidebar_menu_father_id' => "required|exists:sidebar_menu_fathers,id",
        ];

        $logVars=logVars();
        $model = trans('messages.SubMenu');
        $controllerFunction = 'SidebarMenuController.newMenuSubFather';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $this->validate($request, $rules);

            $inputs = $request->all();

            $sidebarMenuSubFather = SidebarMenuSubFather::create($inputs);

            Log::info("Menu New. ".trans('messages.InfoSuccess.Created'),array('context'=>$sidebarMenuSubFather,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));

        } catch (ValidationException $ve) {
            return redirect()->route('admin.sidebarMenus.index')->with('error', $ve->getMessage());
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function updateItem(Request $request, SidebarMenuItem $sidebarMenuItem):RedirectResponse
    {
        $rules = [
            'name'          => 'required|string|max:191|unique:sidebar_menus,name,'.$sidebarMenuItem->id,
            'route'         => 'required|string|max:191|unique:sidebar_menus,name,'.$sidebarMenuItem->id,
            'permission'    => 'required|string|max:191',
            'order'         => 'nullable|numeric|min:1',
        ];

        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.updateItem';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $this->validate($request, $rules);

            $inputs['name'] = $request->name;
            $inputs['route'] = $request->route;
            $inputs['permission'] = $request->permission;
            $inputs['order'] = $request->order;

            $sidebarMenuItem->update($inputs);

            Log::info("Menu Item Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$sidebarMenuItem,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Updated'));

        } catch (ValidationException $ve) {
            return redirect()->route('admin.sidebarMenus.index')->with('error', $ve->getMessage());
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function updateMenuFather(Request $request, SidebarMenuFather $sidebarMenuFather):RedirectResponse
    {
        $sidebarMenuFatherOrderMax =( (SidebarMenuFather::max('order')??0))+1;
        $rules = [
            'name'  => 'required|string|max:191|unique:sidebar_menu_fathers,name,'.$sidebarMenuFather->id,
            'icon'  => 'required|string|max:191',
            'order' => 'nullable|numeric|min:1|max:'.$sidebarMenuFatherOrderMax,
            'order'=> 'nullable',
        ];

        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.updateMenuFather';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $this->validate($request, $rules);

            $inputs = $request->all();

            if ($sidebarMenuFather->order!=$inputs['order']) {
                $orderSidebarMenuFathers = SidebarMenuFather::orderBy('order')->get();
                $count = 1;
                foreach ($orderSidebarMenuFathers as $orderSidebarMenuFather) {
                    if ($inputs['order']==$count ) {
                        $count = $count+1;
                    }
                    $orderSidebarMenuFather->update(['order'=>$count]);
                    if ($orderSidebarMenuFather->id!=$sidebarMenuFather->id) {
                        $count = $count+1;
                    }
                }
            }

            $sidebarMenuFather->update($inputs);

            Log::info("Menu Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$sidebarMenuFather,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Updated'));

        } catch (ValidationException $ve) {
            return redirect()->route('admin.sidebarMenus.index')->with('error', $ve->getMessage());
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function updateMenuSubFather(Request $request, SidebarMenuSubFather $sidebarMenuSubFather):RedirectResponse
    {
        $rules = [
            'name'  => 'required|string|max:191',
            'order' => 'nullable||numeric|min:1',
        ];

        $logVars=logVars();
        $model = trans('messages.SubMenu');
        $controllerFunction = 'SidebarMenuController.updateMenuSubFather';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $this->validate($request, $rules);

            $inputs = $request->all();

            $sidebarMenuSubFather->update($inputs);

            Log::info("Menu Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$sidebarMenuSubFather,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Updated'));

        } catch (ValidationException $ve) {
            return redirect()->route('admin.sidebarMenus.index')->with('error', $ve->getMessage());
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function destroyItem(Request $request, SidebarMenuItem $sidebarMenuItem):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.destroyItem';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $sidebarMenuItem->delete();
            Log::info("Menu item Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$sidebarMenuItem,'logVars'=>$logVars));
            try {
                return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
            } catch (\Throwable $th) {
                throw $th;
            }
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function destroyMenuFather(Request $request, SidebarMenuFather $sidebarMenuFather):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.destroyMenuFather';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $sidebarMenuFather->delete();

            Log::info("Menu Father Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$sidebarMenuFather,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));

        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function destroyMenuSubFather(Request $request, SidebarMenuSubFather $sidebarMenuSubFather):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'SidebarMenuController.destroyMenuSubFather';
        $route = $request->ubi?base64_decode($request->ubi):'admin.sidebarMenus.index';

        try {
            $sidebarMenuSubFather->delete();
            Log::info("Menu item Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$sidebarMenuSubFather,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));

        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.sidebarMenus.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }
}
