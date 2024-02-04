<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Area;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:departments.show|departments.index|departments.create|departments.edit|departments.destroy',['only'=>['index','show']]);
        $this->middleware('permission:departments.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:departments.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:departments.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $departments = Department::all();
        return view('Admin.Departments.index', compact('departments'));
    }

    public function create():View
    {
        $areas = Area::all();
        return view('Admin.Departments.create',compact(
            'areas',
        ));
    }

    public function store(DepartmentStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Department.Departments');
        $controllerFunction = 'DepartmentController.store';
        $route = 'admin.departments.index';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $department = Department::create($inputs);
            if ($request->areas) {
                $department->areas()->sync($request->areas);
            }

            Log::info("Department Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$department,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.departments.edit',$department)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
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

    public function edit(Department $department):View
    {
        $areas = Area::all();
        return view('Admin.Departments.edit',compact(
            'department',
            'areas',
        ));
    }

    public function update(DepartmentUpdateRequest $request, Department $department):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Department.Department');
        $controllerFunction = 'DepartmentController.edit';
        $route = 'admin.departments.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $department->update($inputs);
            $department->areas()->sync($request->areas);

            Log::info("Department Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$department,'logVars'=>$logVars));
            return redirect()->route($route,$department)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.departments.edit',$department)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Department $department):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Department.Department');
        $controllerFunction = 'DepartmentController.destroy';
        $route = 'admin.departments.index';

        try {
            $department->delete();
            Log::info("Department Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$department,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.departments.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
