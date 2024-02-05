<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationStoreRequest;
use App\Http\Requests\NotificationUpdateRequest;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class NotificationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:notifications.show|notifications.index|notifications.create|notifications.edit|notifications.destroy',['only'=>['index','show']]);
        $this->middleware('permission:notifications.create', ['only'=>['create', 'store','sendEmail']]);
        $this->middleware('permission:notifications.edit', ['only'=>['edit', 'update','markAsRead']]);
        $this->middleware('permission:notifications.destroy', ['only'=>['destroy']]);
    }

    public function index():View
    {
        $notifications = Notification::all();
        return view('Admin.Notifications.index', compact('notifications'));
    }

    public function create():View
    {
        $userWorkerSelect = userWorkerSelect();
        return view('Admin.Notifications.create',compact(
            'userWorkerSelect',
        ));
    }

    public function store(NotificationStoreRequest $request):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Notification.Notification');
        $controllerFunction = 'NotificationController.store';
        $route = $request->ubi?base64_decode($request->ubi):'admin.notifications.index';

        $inputs = $request->all();
        $inputs['date'] = date('Y-m-d h:i:s',strtotime(now()));
        $inputs['sender_user_id'] = auth()->user()->id;

        try {
            $notification = Notification::create($inputs);

            Log::info("Notification Store. ".trans('messages.InfoSuccess.Created'),array('context'=>$notification,'logVars'=>$logVars));
            return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Created'));
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

    public function edit(Notification $notification):View
    {
        $userWorkerSelect = userWorkerSelect();
        return view('Admin.Notifications.edit',compact(
            'userWorkerSelect',
            'notification',
        ));
    }

    public function update(NotificationUpdateRequest $request, Notification $notification):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Notification.Notification');
        $controllerFunction = 'NotificationController.update';
        $route = $request->ubi?base64_decode($request->ubi):'admin.notifications.edit';

        $inputs = $request->all();
        $inputs['date'] = date('Y-m-d h:i:s',strtotime(now()));
        $inputs['sender_user_id'] = auth()->user()->id;

        try {
            $notification->update($inputs);

            Log::info("Notification Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$notification,'logVars'=>$logVars));
            return redirect()->route($route,$notification)->with('info',trans('messages.InfoSuccess.Updated'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans("messages.InfoError.Create",['model'=>$model]));
        }
    }

    public function destroy(Notification $notification)
    {
        $logVars=logVars();
        $model = trans('messages.Notification.Notification');
        $controllerFunction = 'NotificationController.destroy';
        try {
            $notification->delete();
            Log::info("Notification Destroy. ".trans('messages.InfoSuccess.Deleted'),array('context'=>$notification,'logVars'=>$logVars));
            return redirect()->route('admin.documents.index')->with('info',trans('messages.InfoSuccess.Deleted'));
        } catch (\Throwable $th) {
            createErrorExceptionLog($th,$controllerFunction);
            return back()
                ->with('error',trans('messages.InfoError.Delete',['model'=>$model]));
        }
    }

    public function markAsRead(Request $request, Notification $notification):RedirectResponse
    {
        $logVars=logVars();
        $model = trans('messages.Notification.Notification');
        $controllerFunction = 'NotificationController.update';
        $route = $request->ubi?base64_decode($request->ubi):'/';
        if (auth()->user()->id === $notification->user_id) {
            try {
                $notification->update([
                    'readed' => 1,
                    'readed_date' => now(),
                ]);
                Log::info("Notification Update. ".trans('messages.InfoSuccess.Updated'),array('context'=>$notification,'logVars'=>$logVars));
                return redirect()->route($route)->with('info',trans('messages.InfoSuccess.Updated'));
            } catch (\Throwable $th) {
                createErrorExceptionLog($th,$controllerFunction);
                return back()
                    ->with('error',trans("messages.InfoError.Updated",['model'=>$model]));
            }
        }
        return redirect()->route($route)->with('warning',trans('messages.InfoSuccess.NotHavePermissions'));
    }
}
