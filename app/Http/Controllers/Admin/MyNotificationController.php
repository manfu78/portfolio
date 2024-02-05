<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MyNotificationController extends Controller
{
    public function index():View
    {
        $notifications = Notification::orderBy('date')->where('user_id','=',auth()->user()->id)->limit(200)->get();
        return view('Admin.MyNotifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request, Notification $notification)
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
