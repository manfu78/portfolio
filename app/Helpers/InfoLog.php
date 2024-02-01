<?php


if(!function_exists('logVars')){
    function logVars (){
        $userAuth = auth()->user()->id.' '.auth()->user()->name.' '.auth()->user()->email;

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



        $logVars = [
            'userAuth'  => $userAuth,
            'ipClient'  => $ipClient,
            'ipRemote'  => $ipRemote,
        ];

        return $logVars;
    }

}
