<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SidebarMenuFather;
use App\Models\SidebarMenuItem;
use App\Models\UserConfig;
use App\Models\UserFavorite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class UserConfigurationController extends Controller
{
    public function favorites():View
    {
        $user = auth()->user();
        $userFavorites = $user->favorites;
        $arrayUserFavorites = $user->favorites?$user->favorites->pluck('sidebar_menu_id')->toArray():null;

        $sidebarMenuFathers = SidebarMenuFather::orderBy('order')->get();

        return view('admin.UserConfigurations.favorites', compact(
            'userFavorites',
            'sidebarMenuFathers',
            'arrayUserFavorites',
        ));
    }

    public function favoriteAdd(Request $request, SidebarMenuItem $sidebarMenuItem):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Menu');
        $controllerFunction = 'UserConfigurationController.favoriteAdd';
        $route = $request->ubi?base64_decode($request->ubi):'admin.userConfigurations.favorites';

        try {
            if (UserFavorite::where('user_id',auth()->user()->id)->where('sidebar_menu_id',$sidebarMenuItem->id)->count()>0) {
                return back()->with('error',trans("messages.InfoError.MenuAlreadyAdded"));
            }

            $favorite = new UserFavorite();

            $favorite->user_id = auth()->user()->id;
            $favorite->sidebar_menu_id = $sidebarMenuItem->id;
            $favorite->save();

            Log::info("Favorite Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$favorite,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.userConfigurations.favorites')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function favoriteDestroy(string $id)
    {
        $logVars=logVars();
        $model = trans('messages.Favorite.Favorite');
        $controllerFunction = 'UserConfigurationController.destroy';
        $route = 'admin.userConfigurations.favorites';

        try {
            //UserFavorite::where('user_id',auth()->user()->id)->where('sidebar_menu_id',$id)->delete();

            Log::info("UserFavorite Destroy. ".trans('messages.InfoSuccess.Deleted'),array('logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.userConfigurations.favorites')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }

    public function homepage():View
    {
        $user = auth()->user();

        $sidebarMenuFathers = SidebarMenuFather::orderBy('order')->get();

        return view('admin.UserConfigurations.homepage', compact(
            'sidebarMenuFathers',
        ));
    }

    public function homeSet(Request $request, SidebarMenuItem $sidebarMenuItem):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Home.Homepage');
        $controllerFunction = 'UserConfigurationController.homeSet';
        $route = $request->ubi?base64_decode($request->ubi):'admin.userConfigurations.homepage';

        try {
            $userConfig = UserConfig::where('user_id',auth()->user()->id)->first();

            if (!$userConfig) {
                $userConfig = new UserConfig();
            }

            $userConfig->user_id = auth()->user()->id;
            $userConfig->sidebar_menu_start_id = $sidebarMenuItem->id;
            $userConfig->save();

            Log::info("Assigned Homepage. ",array('context'=>$sidebarMenuItem,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.userConfigurations.favorites')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function homeUnset(Request $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Home.Homepage');
        $controllerFunction = 'UserConfigurationController.homeUnset';
        $route = $request->ubi?base64_decode($request->ubi):'admin.userConfigurations.homepage';

        try {
            $userConfig = UserConfig::where('user_id',auth()->user()->id)->first();
            $userConfig->sidebar_menu_start_id = null;
            $userConfig->save();

            Log::info("Unset Homepage. ",array('context'=>$userConfig,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.userConfigurations.homepage')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }
}
