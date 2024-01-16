<?php

use App\Models\Expense;
use App\Models\Project;
use App\Models\ProjectChore;

if(!function_exists('projectPercentBar')){
    function projectPercentBar (Project $project){


        $statistics['minutesEstimated'] = 0;
        $statistics['minutesRegistered'] = 0;
        $statistics['redBar'] = 0;
        $statistics['greenBar'] = 0;


        //Registered
        $minutesRegistered = $project->projectTimes->sum('minutes');
        $statistics['minutesRegistered'] =  $minutesRegistered;

        //Estimated
        $estimatedHours = 0;
        $minutesEstimated = 0;
        $estimatedHours = $project->projectChores->sum('estimated_hours');
        $minutesEstimated = $project->projectChores->sum('estimated_minutes');
        if ($estimatedHours>0) {
            $minutesEstimated = $minutesEstimated + ($estimatedHours*60);
        }
        $statistics['minutesEstimated'] =  $minutesEstimated;



        //PERCENT BAR
        $redBar = 0;
        $greenBar = 0;

        if ($minutesRegistered!=0&&$minutesEstimated!=0) {
            $reg = intval($minutesRegistered);
            $est = intval($minutesEstimated);

            if ($reg>$est){
                $total = (($reg*100)/$est);
                $redBar  = intval($total-100);
                $greenBar = 100;
            }else{
                $redBar = 0;
                $greenBar = intval(($minutesRegistered*100)/$minutesEstimated);
            }
        }

        $statistics['redBar'] = $redBar;
        $statistics['greenBar'] = $greenBar;

        return (object) $statistics;
    }
}
