<?php

use App\Models\Event;
use App\Models\WorkCalendar;

if(!function_exists('calendarEvent')){
    function calendarEvent (Event $event){

        $calendarEvent = [
            'eventModelId'=>$event->id,
            'title'=>$event->title,
        ];

        if ($event->all_day) {
            $calendarEvent['allDay']=true;
            if ($event->recurring) {
                $calendarEvent['daysOfWeek']=$event->days_of_week;
                $calendarEvent['startRecur']=$event->start_recur;
                $calendarEvent['endRecur']=$event->end_recur;
            }else{
                $calendarEvent['start']=date('Y-m-d',strtotime($event->start));
            }
        }else{
            if ($event->recurring) {
                $calendarEvent['daysOfWeek']=$event->days_of_week;
                $calendarEvent['startRecur']=$event->start_recur;
                $calendarEvent['endRecur']=$event->end_recur;
                if($event->start_time){$calendarEvent['startTime']=$event->start_time;}
                if($event->end_time){$calendarEvent['endTime']=$event->end_time;}
            }else{
                $calendarEvent['start']=$event->start;
                if($event->end){$calendarEvent['end']=$event->end;}
            }
        }

        if($event->url){$calendarEvent['eventUrl']=$event->url;}
        if($event->description){$calendarEvent['description']=$event->description;}
        // if($event->color){$calendarEvent['color']=$event->color;}

        $users = $event->users;
        $usersArray = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->nameWorker(),
            ];
        });

        $resources = $event->resources;
        $resourcesArray = $resources->map(function ($resource) {
            return [
                'id' => $resource->id,
                'name' => $resource->name,
            ];
        });

        $calendarEvent['eventUsers']=json_encode($usersArray);
        $calendarEvent['eventResources']=json_encode($resourcesArray);




        $calendarEvent = json_encode($calendarEvent);
        return $calendarEvent;
    }
}

if(!function_exists('workCalendarEvent')){
    function workCalendarEvent (WorkCalendar $workCalendar){

        $workCalendarEvent = [
            'title'=> $workCalendar->title,
            'start'=> $workCalendar->start,
            'end'=> $workCalendar->end,
            'display'=> 'background',
            'color'=> $workCalendar->color,
            'eventModelId'=> $workCalendar->id,
        ];

        $workCalendarEvent = json_encode($workCalendarEvent);
        return $workCalendarEvent;
    }
}



