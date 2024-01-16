<?php

use Illuminate\Support\Facades\Log;

if(!function_exists('createErrorExceptionLog')){
    function createErrorExceptionLog ($e,$controllerFunction = null){
        Log::error(
            $e->getMessage(),array(
                'Message'=>$e->getMessage(),
                'File'=>$e->getFile(),
                'Source Line'=>$e->getLine(),
                'ControllerFunction'=>$controllerFunction??'not defined',
                'info'=>logVars(),
            ));
    }
}
