<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoinTypeStoreRequest;
use App\Http\Requests\CoinTypeUpdateRequest;
use App\Models\CoinType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CoinTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:coinTypes.show|coinTypes.index|coinTypes.create|coinTypes.edit|coinTypes.destroy',['only'=>['index','show']]);
        $this->middleware('permission:coinTypes.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:coinTypes.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:coinTypes.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $coinTypes = CoinType::all();
        return view('Admin.CoinTypes.index', compact('coinTypes'));
    }

    public function create():View
    {
        return view('Admin.CoinTypes.create');
    }

    public function store(CoinTypeStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.CoinType.CoinTypes');
        $controllerFunction = 'CoinTypeController.store';
        $route = 'admin.coinTypes.index';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        $coinTypeDefault = CoinType::where('default','=',1)->first();
        if (!$request->default&&$coinTypeDefault) {
            $inputs['default']='0';
        }else{
            if($coinTypeDefault){
                $coinTypeDefault->default = 0;
                $coinTypeDefault->save();
            }
            $inputs['default']='1';
        }

        try {
            $coinType = CoinType::create($inputs);
            Log::info("CoinType Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$coinType,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.coinTypes.edit',$coinType)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function edit(CoinType $coinType):View
    {
        return view('Admin.CoinTypes.edit',compact('coinType'));
    }

    public function update(CoinTypeUpdateRequest $request, CoinType $coinType):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.CoinType.CoinType');
        $controllerFunction = 'CoinTypeController.update';
        $route = 'admin.coinTypes.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;
        $inputs['default']=0;

        if ($request->default) {
            $coinTypeDefault = CoinType::where('default','=',1)->first();
            if($coinTypeDefault){
                $coinTypeDefault->default = 0;
                $coinTypeDefault->save();
            }
            $inputs['default']=1;
        }

        try {
            $coinType->update($inputs);

            Log::info("CoinType Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$coinType,'logVars'=>$logVars));
            return redirect()->route($route,$coinType)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.coinTypes.edit',$coinType)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(CoinType $coinType):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.CoinType.CoinType');
        $controllerFunction = 'CoinTypeController.destroy';
        $route = 'admin.coinTypes.index';

        if ($coinType->default ===1) {
            return back()->with('error',trans('messages.InfoError.DeleteDefault',['model'=>$model]));
        }

        try {
            $coinType->delete();

            Log::info("CoinType Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$coinType,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.coinTypes.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
