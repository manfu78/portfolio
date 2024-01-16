<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $worker = null;//$user->worker;
        return view('common.Profile.show', compact(
            'user',
            'worker',
        ));
    }
}
