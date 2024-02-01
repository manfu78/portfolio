<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:categories.show|categories.index|categories.create|categories.edit|categories.destroy',['only'=>['index','show']]);
        $this->middleware('permission:categories.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:categories.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:categories.destroy', ['only'=>['destroy']]);
    }
    public function index():View
    {
        $categories = Category::all();
        return view('Admin.Categories.index', compact('categories'));
    }

    public function create():View
    {
        return view('Admin.Categories.create');
    }

    public function store(CategoryStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Category.Categories');
        $controllerFunction = 'CategoryController.store';
        $route = 'admin.categories.index';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $category = Category::create($inputs);
            Log::info("Category Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$category,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.categories.edit',$category)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
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

    public function edit(Category $category):View
    {
        return view('Admin.categories.edit',compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Category.Category');
        $controllerFunction = 'CategoryController.edit';
        $route = 'admin.categories.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $category->update($inputs);
            Log::info("Category Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$category,'logVars'=>$logVars));
            return redirect()->route($route,$category)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.categories.edit',$category)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Category $category):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Category.Category');
        $controllerFunction = 'CategoryController.destroy';
        $route = 'admin.categories.index';

        try {
            $category->delete();
            Log::info("Category Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$category,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.categories.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (ErrorException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return back()->with('warning',trans('messages.InfoError.CanNotBeDeleted'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
