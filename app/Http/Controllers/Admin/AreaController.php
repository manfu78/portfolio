<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaStoreRequest;
use App\Http\Requests\AreaUpdateRequest;
use App\Models\Area;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AreaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:areas.show|areas.index|areas.create|areas.edit|areas.destroy',['only'=>['index','show']]);
        $this->middleware('permission:areas.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:areas.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:areas.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $areas = Area::all();
        return view('Admin.Areas.index', compact('areas'));
    }

    public function create():View
    {
        $departments = Department::all();
        $businessSelect = businessSelect();
        return view('Admin.Areas.create',compact(
            'departments',
            'businessSelect',
        ));
    }

    public function store(AreaStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Area.Areas');
        $controllerFunction = 'AreaController.store';
        $route = 'admin.areas.index';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $area = Area::create($inputs);
            $area->departments()->sync($request->departments);

            Log::info("Area Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$area,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.areas.edit',$area)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Area $area):View
    {
        $departments = Department::all();

        $businessSelect = businessSelect();
        return view('Admin.Areas.edit',compact(
            'area',
            'departments',
            'businessSelect',
        ));
    }

    public function update(AreaUpdateRequest $request, Area $area):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Area.Area');
        $controllerFunction = 'AreaController.edit';
        $route = 'admin.areas.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $area->update($inputs);
            $area->departments()->sync($request->departments);

            Log::info("Area Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$area,'logVars'=>$logVars));
            return redirect()->route($route,$area)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.areas.edit',$area)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Area $area):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Area.Area');
        $controllerFunction = 'AreaController.destroy';
        $route = 'admin.areas.index';

        try {
            $area->delete();
            Log::info("Area Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$area,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.areas.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
