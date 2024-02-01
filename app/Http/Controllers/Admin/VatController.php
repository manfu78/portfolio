<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VatStoreRequest;
use App\Http\Requests\VatUpdateRequest;
use App\Models\Vat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class VatController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vats.show|vats.index|vats.create|vats.edit|vats.destroy',['only'=>['index','show']]);
        $this->middleware('permission:vats.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:vats.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:vats.destroy', ['only'=>['destroy']]);
    }
    public function index():View
    {
        $vats = Vat::all();
        return view('Admin.Vats.index', compact('vats'));
    }

    public function create():View
    {
        return view('Admin.Vats.create');
    }

    public function store(VatStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Vat.Vats');
        $controllerFunction = 'VatController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.vats.index';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $vat = Vat::create($inputs);
            Log::info("Vat Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$vat,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.vats.edit',$vat)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show(string $id)
    {
        //return redirect()->route('admin.vats.index');
    }

    public function edit(Vat $vat):View
    {
        return view('Admin.Vats.edit',compact('vat'));
    }

    public function update(VatUpdateRequest $request, Vat $vat):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Vat.Vat');
        $controllerFunction = 'VatController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.vats.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $vat->update($inputs);
            Log::info("Vat Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$vat,'logVars'=>$logVars));
            return redirect()->route($route,$vat)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.vats.edit',$vat)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request, Vat $vat):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Vat.Vat');
        $controllerFunction = 'VatController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.vats.index';

        try {
            $vat->delete();
            Log::info("Vat Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$vat,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.vats.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
