<?php

use App\Models\Business;
use App\Models\ProjectChore;
use App\Models\ProjectRate;

if(!function_exists('myPendingProjectChores')){
    function myPendingProjectChores (){
        $pendingProjectChores = auth()->user()->userProfile->projectChores->where('chore_state_id','=',1);
        return $pendingProjectChores;
    }
}


if(!function_exists('myInProgressProjectChores')){
    function myInProgressProjectChores (){
        $inProgressProjectChores = auth()->user()->userProfile->projectChores->where('chore_state_id','=',3);
        return $inProgressProjectChores;
    }
}

if(!function_exists('infoHeader')){
    function infoHeader (){

        $userAuth = auth()->user();
        $userProfile = $userAuth->userProfile;
        $pendingProjectChores = null;
        $inProgressProjectChores = null;
        $pausedProjectChores = null;
        $headerProjectRates = ProjectRate::All()->pluck('name','id');

        if($userProfile){
            $pendingProjectChores = ProjectChore::orderBy('created_at','desc')->where('user_profile_id','=',$userProfile->id)->where('chore_state_id','=',1)->limit(5)->get();
            $inProgressProjectChores = ProjectChore::orderBy('created_at','desc')->where('user_profile_id','=',$userProfile->id)->where('chore_state_id','=',3)->limit(5)->get();
            $pausedProjectChores = ProjectChore::orderBy('created_at','desc')->where('user_profile_id','=',$userProfile->id)->where('chore_state_id','=',2)->limit(5)->get();
        }

        return[
            'pendingProjectChores'          => $pendingProjectChores,
            'inProgressProjectChores'       => $inProgressProjectChores,
            'pausedProjectChores'           => $pausedProjectChores,
            'headerProjectRates'            => $headerProjectRates,
        ];
    }
}

if(!function_exists('businessDefault')){
    function businessDefault ()
    {
        $businessDefault = Business::where('default','=',1)->first();
        return $businessDefault;
    }
}

if(!function_exists('businessIsSpm')){
    function businessIsSpm ()
    {
        $businessDefault = Business::where('default','=',1)->first();
        $businessIsSpm = false;
        if ($businessDefault&&$businessDefault->cif=='B73858524') {
            $businessIsSpm = true;
        }
        return $businessIsSpm;
    }
}


