<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccountStoreRequest;
use App\Http\Requests\BankAccountUpdateRequest;
use App\Models\BankAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class BankAccountController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bankAccounts.show|bankAccounts.index|bankAccounts.create|bankAccounts.edit|bankAccounts.destroy',['only'=>['index','show']]);
        $this->middleware('permission:bankAccounts.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:bankAccounts.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:bankAccounts.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $bankAccounts = BankAccount::all();
        return view('Admin.BankAccounts.index', compact('bankAccounts'));
    }

    public function create():View
    {
        return view('Admin.BankAccounts.create');
    }

    public function store(BankAccountStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.BankAccount.BankAccounts');
        $controllerFunction = 'BankAccountController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.bankAccounts.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $bankAccount = BankAccount::create($inputs);
            Log::info("BankAccount Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$bankAccount,'logVars'=>$logVars));
            return redirect()->route($route,$bankAccount)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.bankAccounts.edit',$bankAccount)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
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

    public function edit(BankAccount $bankAccount):View
    {
        return view('Admin.BankAccounts.edit',compact('bankAccount'));
    }

    public function update(BankAccountUpdateRequest $request, BankAccount $bankAccount):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.BankAccount.BankAccount');
        $controllerFunction = 'BankAccountController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.bankAccounts.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $bankAccount->update($inputs);
            Log::info("BankAccount Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$bankAccount,'logVars'=>$logVars));
            return redirect()->route($route,$bankAccount)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.bankAccounts.edit',$bankAccount)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request, BankAccount $bankAccount):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.BankAccount.BankAccount');
        $controllerFunction = 'BankAccountController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.bankAccounts.index';

        try {
            $bankAccount->delete();
            Log::info("BankAccount Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$bankAccount,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.bankAccounts.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
