<?php

if(!function_exists('minutesFormatter')){
    function minutesFormatter ($minutesTot = null,$format = null){
        $minutesFormatter = '0m';
        $class = '';
        if ($minutesTot!=null&&is_numeric($minutesTot)) {
            if($minutesTot<0){
                $minutesTot = ($minutesTot*(-1));
                $class = 'text-danger';
            }
            switch ($format) {
                case 'd':
                    $days = floor($minutesTot/1440);//dias
                    $resto = ($minutesTot-($days*1440));
                    $hours = floor($resto/60);
                    $minutes = ($resto-($hours*60));
                    $minutesFormatter = ($days>0?$days.'d ':'').($hours>0?$hours.'h ':'').$minutes.'m';
                    break;
                default:
                    $hours = floor($minutesTot/60);
                    $minutes = ($minutesTot-($hours*60));
                    $minutesFormatter = ($hours>0?$hours.'h ':'').$minutes.'m';
                    break;
            }
        }
        $minutesFormatter = '<spam class="'.$class.'">'.$minutesFormatter.'</spam>';
        return $minutesFormatter;
    }
}
