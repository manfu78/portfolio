<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodStoreRequest;
use App\Http\Requests\PaymentMethodUpdateRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class PaymentMethodController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paymentMethods.show|paymentMethods.index|paymentMethods.create|paymentMethods.edit|paymentMethods.destroy',['only'=>['index','show']]);
        $this->middleware('permission:paymentMethods.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:paymentMethods.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:paymentMethods.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $paymentMethods = PaymentMethod::all();
        return view('Admin.PaymentMethods.index', compact('paymentMethods'));
    }

    public function create():View
    {
        return view('Admin.PaymentMethods.create');
    }

    public function store(PaymentMethodStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.PaymentMethod.PaymentMethods');
        $controllerFunction = 'PaymentMethodsController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.paymentMethods.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $paymentMethod = PaymentMethod::create($inputs);

            Log::info("PaymentMethod Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$paymentMethod,'logVars'=>$logVars));
            return redirect()->route($route,$paymentMethod)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.paymentMethods.edit',$paymentMethod)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function edit(PaymentMethod $paymentMethod):View
    {
        return view('Admin.PaymentMethods.edit',compact('paymentMethod'));
    }

    public function update(PaymentMethodUpdateRequest $request, PaymentMethod $paymentMethod):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.PaymentMethod.PaymentMethod');
        $controllerFunction = 'PaymentMethodsController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.paymentMethods.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $paymentMethod->update($inputs);

            Log::info("PaymentMethod Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$paymentMethod,'logVars'=>$logVars));
            return redirect()->route($route,$paymentMethod)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.paymentMethods.edit',$paymentMethod)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request, PaymentMethod $paymentMethod):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.PaymentMethod.PaymentMethod');
        $controllerFunction = 'PaymentMethodsController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.paymentMethods.index';

        try {
            $paymentMethod->delete();

            Log::info("PaymentMethod Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$paymentMethod,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.paymentMethods.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
