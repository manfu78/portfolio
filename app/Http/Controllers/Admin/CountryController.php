<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class CountryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:countries.show|countries.index|countries.create|countries.edit|countries.destroy',['only'=>['index','show']]);
        $this->middleware('permission:countries.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:countries.edit', ['only'=>['edit', 'update','setUser']]);
        $this->middleware('permission:countries.destroy', ['only'=>['destroy']]);
    }
    public function index():View
    {
        $countries = Country::all();
        return view('Admin.Countries.index', compact('countries'));
    }

    public function create():View
    {
        return view('Admin.Countries.create');
    }

    public function store(CountryStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Country.Countries');
        $controllerFunction = 'CountryController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.countries.index';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $country = Country::create($inputs);

            Log::info("Country Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$country,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$country)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
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

    public function edit(Country $country):View
    {
        return view('Admin.Countries.edit',compact('country'));
    }

    public function update(CountryUpdateRequest $request, Country $country):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Country.Country');
        $controllerFunction = 'CountryController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.countries.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {
            $country->update($inputs);
            Log::info("Country Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$country,'logVars'=>$logVars));
            return redirect()->route($route,$country)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.edit',$country)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Country $country):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Country.Country');
        $controllerFunction = 'CountryController.destroy';
        $route = 'admin.countries.index';

        try {
            $country->delete();

            Log::info("Country Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$country,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.countries.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }
}
