<?php

use App\Models\Expense;
use App\Models\Project;
use App\Models\ProjectChore;

if(!function_exists('projectStatistics')){
    function projectStatistics (Project $project){

        $projectChores = $project->projectChores;
        $projectTimes = $project->projectTimes;
        $projectTimesBillable = $projectTimes->where('billable','=',1);
        $projectTimesNoBillable = $projectTimes->where('billable','=',0);

        $projectChoresCount = $projectChores->where('project_state_id','<>',4)->count();
        $projectChoresFinishedCount = $projectChores->where('chore_state_id','=',5)->count();


        $statistics['timeRegisteredRateCost'] = 0;
        $statistics['sumProjectExpensesEu'] =  0;
        $statistics['totalCost'] =  0;
        $statistics['minutesEstimated'] = 0;
        $statistics['timeEstimatedCost'] = 0;
        $statistics['minutesRegistered'] = 0;
        $statistics['minutesRegisteredNoBillable'] = 0;
        $statistics['minutesRegisteredBillable'] = 0;
        $statistics['timeRegisteredRateCost'] = 0;
        $statistics['timeRegisteredCostBillable'] = 0;
        $statistics['timeRegisteredCostNoBillable'] = 0;
        $statistics['margenTime'] = 0;
        $statistics['projectChoresRelation'] = 0;
        $statistics['projectChoresRelationPercent'] = 0;
        // $statistics['percentajeRegistered'] = 0;
        // $statistics['percentajeExceeded'] = 0;
        $statistics['redBar'] = 0;
        $statistics['greenBar'] = 0;



        //Costes
        $timeRegisteredRateCost = 0;
        foreach ($projectTimes as $projectTime) {
            $timeRegisteredRateCost = $timeRegisteredRateCost + ($projectTime->rate_cost*($projectTime->minutes/60));
        }
        $statistics['timeRegisteredRateCost'] =  $timeRegisteredRateCost;

        $sumExpensesEu = 0;
        $projectExpenses = $project->expenses;
        foreach ($projectExpenses as $projectExpense) {
            $expenseEu = ($projectExpense->total*$projectExpense->coinType->equivalence);
            $sumExpensesEu = $sumExpensesEu+$expenseEu;
        }

        $projectChoreExpensesArray = $project->projectChores->pluck('id');
        $projectChoreExpenses = Expense::whereIn('project_chore_id',$projectChoreExpensesArray)->get();
        foreach ($projectChoreExpenses as $projectChoreExpense) {
            $expenseEu = ($projectChoreExpense->total*$projectChoreExpense->coinType->equivalence);
            $sumExpensesEu = $sumExpensesEu+$expenseEu;
        }

        $statistics['sumProjectExpensesEu'] =  $sumExpensesEu;

        $statistics['totalCost'] =  $timeRegisteredRateCost+$sumExpensesEu;


        //Tiempos
        $estimatedHours = 0;
        $minutesEstimated = 0;
        $estimatedHours = $projectChores->sum('estimated_hours');
        $minutesEstimated = $projectChores->sum('estimated_minutes');
        if ($estimatedHours>0) {
            $minutesEstimated = $minutesEstimated + ($estimatedHours*60);
        }
        $statistics['minutesEstimated'] =  $minutesEstimated;

        $timeEstimatedCost = 0;
        foreach ($projectChores as $projectChore) {
            $hoursEstimated = $projectChore->estimated_hours;
            $minutesEstimatedC = $projectChore->estimated_minutes;
            $timeEstimatedHours = $hoursEstimated + ($minutesEstimatedC/60);
            $timeEstimatedCost = $timeEstimatedCost + ($projectChore->projectRate->cost*$timeEstimatedHours);
        }
        $statistics['timeEstimatedCost'] =  $timeEstimatedCost;


        $minutesRegistered = $projectTimes->sum('minutes');
        $statistics['minutesRegistered'] =  $minutesRegistered;


        $minutesRegisteredNoBillable = $projectTimesNoBillable->sum('minutes');
        $statistics['minutesRegisteredNoBillable'] =  $minutesRegisteredNoBillable;



        $minutesRegisteredBillable = $projectTimesBillable->sum('minutes');
        $statistics['minutesRegisteredBillable'] =  $minutesRegisteredBillable;


        $timeRegisteredCostNoBillable = 0;
        foreach ($projectTimesNoBillable as $projectTimeNoBillable) {
            $timeRegisteredCostNoBillable = $timeRegisteredCostNoBillable + ($projectTimeNoBillable->rate_cost*($projectTimeNoBillable->minutes/60));
        }
        $statistics['timeRegisteredCostNoBillable'] =  $timeRegisteredCostNoBillable;


        $timeRegisteredCostBillable = 0;
        foreach ($projectTimesBillable as $projectTimeBillable) {
            $timeRegisteredCostBillable = $timeRegisteredCostBillable + ($projectTimeBillable->rate_cost*($projectTimeBillable->minutes/60));
        }
        $statistics['timeRegisteredCostBillable'] =  $timeRegisteredCostBillable;


        $margen = $timeEstimatedCost-$timeRegisteredRateCost;
        $statistics['margen'] = $margen;

        $margenTime = $minutesEstimated-$minutesRegistered;
        $statistics['margenTime'] = $margenTime;

        $minutesExceeded = 0;
        if(($minutesEstimated>0)&&($minutesEstimated<$minutesRegistered)){
            $minutesExceeded = ($minutesRegistered-$minutesEstimated);
        }
        $statistics['minutesExceeded'] =   $minutesExceeded;


        $projectChoresRelation = 0;
        $projectChoresRelation = $projectChoresFinishedCount.' / '.$projectChoresCount;
        $statistics['projectChoresRelation'] = $projectChoresRelation;



        $projectChoresRelationPercent = 0;
        if($projectChoresCount>0){
            $projectChoresRelationPercent = ($projectChoresFinishedCount*100)/$projectChoresCount;
        }
        $statistics['projectChoresRelationPercent'] = $projectChoresRelationPercent;


        // $percentajeRegistered = 0;
        // $processExceeded=0;

        // if($minutesRegistered!=0){
        //     if ($minutesRegistered>=$minutesEstimated){
        //         $exceeded = $minutesRegistered-$minutesEstimated;
        //         $totalProcess = $minutesEstimated+$minutesRegistered;

        //         $processExceeded = intval(($exceeded*100)/$totalProcess);
        //         $percentajeRegistered = 100-$processExceeded;
        //     }else{
        //         $percentajeRegistered = intval(($minutesRegistered*100)/$minutesEstimated);
        //     }
        // }
        // $statistics['percentajeRegistered'] = $percentajeRegistered;


        // $percentajeExceeded = 0;
        // if($minutesRegistered!=0){
        //     if ($minutesRegistered>=$minutesEstimated){
        //         $exceeded = $minutesRegistered-$minutesEstimated;
        //         $totalProcess = $minutesEstimated+$minutesRegistered;

        //         $percentajeExceeded = intval(($exceeded*100)/$totalProcess);
        //     }
        // }
        // $statistics['percentajeExceeded'] = $percentajeExceeded;


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
