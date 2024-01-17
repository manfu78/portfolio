<?php


if(!function_exists('logVars')){
    function logVars (){
        $userAuth = auth()->user();

        $ipRemote = null;
        if (getenv('HTTP_CLIENT_IP')) {
            $ipRemote = getenv('HTTP_CLIENT_IP');
        }elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipRemote = getenv('HTTP_X_FORWARDED_FOR');
        }elseif (getenv('HTTP_X_FORWARDED')) {
            $ipRemote = getenv('HTTP_X_FORWARDED');
        }elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipRemote = getenv('HTTP_FORWARDED_FOR');
        }elseif (getenv('HTTP_FORWARDED')) {
            $ipRemote = getenv('HTTP_FORWARDED');
        }else {
            $ipRemote = getenv('REMOTE_ADDR');
        }

        $ipClient = request()->ip();

        // $userName = $userAuth?$userAuth->name:'';

        // if ($userAuth&&$userAuth->userProfile) {
        //     $userName = $userAuth->userProfile->name.' '.$userAuth->userProfile->lastname;
        // }

        $logVars = [
            'userAuth'  => $userAuth,
            'ipClient'  => $ipClient,
            'ipRemote'  => $ipRemote,
        ];

        return $logVars;
    }

}
