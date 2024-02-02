<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request)//: View
    {
        // return (sidebarMenuFathers());
        $user = $request->user();
        $worker = $user->worker;
        $businessSelect = businessSelect();
        $countrySelect = countrySelect();
        $categorySelect = categorySelect();
        $departmentSelect = departmentSelect();
        $areaSelect = areaSelect();

        return view('Admin.Profile.show', compact(
            'user',
            'worker',
            'businessSelect',
            'countrySelect',
            'categorySelect',
            'departmentSelect',
            'areaSelect',
        ));
    }
}
