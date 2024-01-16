<?php

use App\Models\ProjectChore;
use Illuminate\Support\Collection;

if(!function_exists('projectChoreStatistics')){
    function projectChoreStatistics (ProjectChore $projectChore){

        $projectTimes = $projectChore->projectTimes;
        $minutesProjectTimes = $projectTimes->sum('minutes');
        // $minutesProjectChore = $projectTimes->sum('minutes');

        $statistics['timeMinutesByProject'] = 0;
        $statistics['minutesRegistered'] = 0;
        $statistics['minutesEstimated'] = 0;
        $statistics['minutesExceeded'] = 0;
        $statistics['percentajeTime'] = 0;
        $statistics['percentajeRegistered'] = 0;
        $statistics['percentajeExceeded'] = 0;



        $timeMinutesByProject = 0;
        $timeMinutesByProject = $minutesProjectTimes;
        $statistics['timeMinutesByProject'] = $timeMinutesByProject;


        $minutesRegistered = 0;
        $minutesRegistered = $minutesProjectTimes;
        $statistics['minutesRegistered'] =  $minutesRegistered;


        $minutesEstimated = 0;
        $hoursEstimatedToMinutes = 0;
        if ($projectChore->estimated_hours) {
            $hoursEstimatedToMinutes = ($projectChore->estimated_hours*60);
        }
        $minutesEstimated = $hoursEstimatedToMinutes+$projectChore->estimated_minutes;
        $statistics['minutesEstimated'] =  $minutesEstimated;


        $minutesExceeded = 0;
        if(($minutesEstimated>0)&&($minutesEstimated<$minutesRegistered)){
            $minutesExceeded = ($minutesRegistered-$minutesEstimated);
        }
        $statistics['minutesExceeded'] =  $minutesExceeded;


        $percentajeTime = 0;
        if ($minutesEstimated>0) {
            $percentajeTime = number_format(($minutesRegistered*100)/($minutesEstimated), 2, '.','');
        }else{
            $percentajeTime = 100;
        }
        $statistics['percentajeTime'] =  $percentajeTime;



        $percentajeRegistered = 0;
        $processExceeded=0;
        $totalMinutes = $minutesProjectTimes;
        $totalMinutesEstimated = $minutesEstimated;
        if ($totalMinutes>=$totalMinutesEstimated){
            $exceeded = $totalMinutes-$totalMinutesEstimated;
            $totalProcess = $totalMinutesEstimated+$totalMinutes;
            if($exceeded>0){
                $processExceeded = intval(($exceeded*100)/$totalProcess);
                $percentajeRegistered = 100-$processExceeded;
            }
        }else{
            if ($totalMinutesEstimated>0) {
                $percentajeRegistered = intval(($totalMinutes*100)/$totalMinutesEstimated);
            }else{
                $percentajeRegistered = 100;
            }

        }
        $statistics['percentajeRegistered'] =  $percentajeRegistered;



        $percentajeExceeded = 0;
        $totalMinutes = $minutesProjectTimes;
        $totalMinutesEstimated = $minutesEstimated;

        if ($totalMinutes>=$totalMinutesEstimated){
            $exceeded = $totalMinutes-$totalMinutesEstimated;
            $totalProcess = $totalMinutesEstimated+$totalMinutes;

            if ($totalProcess>0) {
                $percentajeExceeded = intval(($exceeded*100)/$totalProcess);
            }else{
                $percentajeExceeded = 100;
            }

        }
        $statistics['percentajeExceeded'] =  $percentajeExceeded;




        return (object) $statistics;
    }
}
