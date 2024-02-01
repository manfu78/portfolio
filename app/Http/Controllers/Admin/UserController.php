<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\UserProfile;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users.show|users.index|users.create|users.edit|users.destroy',['only'=>['index','show']]);
        $this->middleware('permission:users.create', ['only'=>['create', 'store']]);
        $this->middleware('permission:users.edit', ['only'=>[
            'edit', 'update',
            'setUserProfile','unsetUserProfile'
        ]]);
        $this->middleware('permission:users.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $users = User::all();
        return view('Admin.Users.index',compact('users'));
    }

    public function create(Request $request)
    {
        $userProfiles = UserProfile::orderBy('name')->where('status','=',1)->get();
        $roles = Role::all();

        $userProfileAsign = $request->userProfile_id?(UserProfile::find($request->userProfile_id)):null;

        return view('Admin.Users.create',compact(
            'roles',
            'userProfiles',
            'userProfileAsign',
        ));
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $logVars = logVars();
        $model = trans('messages.User.User');
        $controllerFunction = 'UserController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.users.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                //'status'=>1,
            ]);

            if($request->userProfile_id){
                UserProfile::where('user_id','=',$user->id)->update(['user_id'=>null]);
                $userProfile = UserProfile::find($request->userProfile_id);
                $userProfile->update(['user_id'=>$user->id]);
            }

            try {
                $user->roles()->sync($request->roles);
            } catch (\Throwable $th) {
                throw new Exception(trans("messages.InfoError.ToAssignRoles",['model'=>$model]));
            }

            Log::info("User Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$user,'logVars'=>$logVars));
            return redirect(route($route,$user))->with('info',trans('messages.InfoSuccess.Created'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.users.edit',$user)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function show(string $id)//:View
    {
        //
    }

    public function edit(User $user):View
    {
        $userProfiles = UserProfile::orderBy('name')->where('status','=',1)->get();
        $roles = Role::all();

        $modules = $user->getAllPermissions()->whereNotNull('menu');
        $modules = $modules->sortBy('selectMenu')->pluck('selectMenu','name');

        return view('Admin.Users.edit',compact(
            'user',
            'userProfiles',
            'roles',
            'modules',
        ));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $logVars = logVars();
        $model = trans('messages.User.User');
        $controllerFunction = 'UserController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.users.edit';

        $inputs = $request->all();
        $inputs['user_id_mod'] = auth()->user()->id;

        if (!empty($inputs['password'])){
            $inputs['password'] = Hash::make($inputs['password']);
        }else{
            $inputs = Arr::except($inputs, array('password'));
        }

        try {
            $user->update($inputs);

            try {
                $user->roles()->sync($request->roles);
            } catch (\Throwable $th) {
                throw new Exception(trans("messages.InfoError.ToAssignRole",['model'=>$model]));
            }

            Log::info("User Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$user,'logVars'=>$logVars));
            return redirect()->route($route,$user)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.users.edit',$user)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }

    public function destroy(Request $request,User $user)
    {
        $logVars = logVars();
        $model = trans('messages.User.User');
        $controllerFunction = 'UserController.destroy';
        $route = $request->ubi?base64_decode($request->ubi):'admin.users.index';

        try {
            if ($user->username == 'SuperAdmin'){
                return back()->with(trans('error','messages.InfoError.CanNotBeDeleted'));
            }

            if ($user->image && $user->image!=''){
                if (Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }
            }

            $user->tokens->each->delete();
            $user->delete();

            Log::info("User Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$user,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.users.index')->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Delete",['model'=>$model]));
        }
    }

    public function setUserProfile(Request $request,User $user, UserProfile $userProfile):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.User.User');
        $controllerFunction = 'UsersController.setUserProfile';
        $route = $request->ubi?base64_decode($request->ubi):'admin.users.edit';

        try {
            $userProfile->user_id = $user->id;
            $userProfile->save();

            $user->user_id_mod = auth()->user()->id;
            $user->save();

            Log::info("User Update. Asociado Trabajador a Usuario",array('context'=>$user,'info'=>$logVars,));
            return redirect()->route($route,$user)
                ->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.users.edit',$user)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }

    }

    public function unsetUserProfile(Request $request, User $user, UserProfile $userProfile):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.User.User');
        $controllerFunction = 'UserController.unsetUserProfile';
        $route = $request->ubi?base64_decode($request->ubi):'admin.users.edit';

        try {
            $userProfile->user_id = null;
            $userProfile->save();

            $user->user_id_mod = auth()->user()->id;
            $user->save();

            Log::info("User Update. Quitado Trabajador asociado a Usuario.",array('context'=>$user,'info'=>$logVars,));
            return redirect()->route($route,$user)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (RouteNotFoundException $re) {
            createErrorExceptionLog($re,$controllerFunction);
            return redirect()->route('admin.users.edit',$user)->with('warning',trans('messages.InfoSuccess.CreatedButError'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()->with('error',trans("messages.InfoError.Update",['model'=>$model]));
        }
    }
}
