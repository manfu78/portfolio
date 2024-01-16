<?php

use App\Models\Area;
use App\Models\Business;
use App\Models\Category;
use App\Models\CoinType;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Opportunity;
use App\Models\PaymentMethod;
use App\Models\Priority;
use App\Models\Project;
use App\Models\ProjectChore;
use App\Models\ProjectExpense;
use App\Models\ProjectManager;
use App\Models\ProjectPriority;
use App\Models\ProjectRate;
use App\Models\SidebarMenuFather;
use App\Models\User;
use App\Models\Vat;
use App\Models\Worker;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;



if(!function_exists('userSelect')){
    function userSelect ():array
    {
        try {
            $userSelect = User::orderBy('name')
                ->pluck('name','id')
                ->toarray();
            return $userSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}

if(!function_exists('userWorkerSelect')){
    function userWorkerSelect ():array
    {
        try {
            $userWorkerSelect = User::orderBy('name')->with('worker')
                ->get();

            foreach ($userWorkerSelect as $key => $user) {
                if ($user->worker) {
                    $userWorkerSelect[$key]->name = $user->worker->name.' '.$user->worker->lastname;
                }
            }
            return $userWorkerSelect->pluck('name','id')->toarray();
        } catch (\Throwable $th) {
            return [];
        }
    }
}

if(!function_exists('workerSelect')){
    function workerSelect ( $except = null):array
    {
        try {
            $workerSelect = Worker::where('status','=',1);
            if ($except) {
                $workerSelect = $workerSelect->whereNotIn('id',$except);
            }
            $workerSelect = $workerSelect->select("id",
                DB::raw('CONCAT(id,"-",name," ",lastname) AS name_sel'))
                    ->orderBy('name_sel')
                    ->pluck('name_sel','id')
                    ->toarray();
            return $workerSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('documentTypeSelect')){
    function documentTypeSelect ():array
    {
        try {
            $documentTypeSelect = DocumentType::orderBy('type')
                ->pluck('type','id')
                ->toarray();
        return $documentTypeSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('customerSelect')){
    function customerSelect ():array
    {
        try {
            $customerSelect = Customer::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->orderBy('name_sel')
                ->pluck('name_sel','id')
                ->toarray();
            return $customerSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('businessSelect')){
    function businessSelect ():array
    {
        try {
            $businessSelect = Business::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->orderBy('name_sel')
                ->pluck('name_sel','id')->toarray();
            return $businessSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('areaSelect')){
    function areaSelect ():array
    {
        try {
            $areaSelect = Area::orderBy('name')
                ->pluck('name','id')
                ->toarray();
            return $areaSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('departmentSelect')){
    function departmentSelect ():array
    {
        try {
            $departmentSelect = Department::orderBy('name')
                ->pluck('name','id')
                ->toarray();
            return $departmentSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('projectSelect')){
    function projectSelect ():array
    {
        try {
            $projectSelect = Project::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->whereNotIn('projects.project_state_id',[3,4])
                ->orderBy('name_sel')
                ->pluck('name_sel','id');
            return $projectSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('subtaskSelect')){
    function subtaskSelect (ProjectChore $projectChore = null):array
    {
        try {
            $subtask = $projectChore->subtasks->where('finished','<>',1)
                ->pluck('name','id')
                ->toarray();
            return $subtask;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('projectRateSelect')){
    function projectRateSelect ():array
    {
        try {
            $projectRate = ProjectRate::All()
                ->pluck('name','id')
                ->torarray();
            return $projectRate;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('projectChoreSelect')){
    function projectChoreSelect ():array
    {
        try {
            $projectChoreSelect = ProjectChore::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->orderBy('name_sel')
                ->pluck('name_sel','id')
                ->toarray();
            return $projectChoreSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('opportunitySelect')){
    function opportunitySelect ():array
    {
        try {
            $opportunitySelect = Opportunity::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->orderBy('name_sel')
                ->pluck('name_sel','id')
                ->toarray();
            return $opportunitySelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('coinTypeSelect')){
    function coinTypeSelect ():array
    {
        try {
            $coinTypeSelect = CoinType::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->orderBy('name_sel')
                ->pluck('name_sel','id')
                ->toarray();
            return $coinTypeSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('prioritySelect')){
    function prioritySelect ():array
    {
        try {
            $prioritySelect = Priority::orderBy('id')
                ->pluck('name','id')
                ->toarray();
            return $prioritySelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('projectPrioritySelect')){
    function projectPrioritySelect ():array
    {
        try {
            $projectPrioritySelect = ProjectPriority::select("id",
            DB::raw('CONCAT(id,"-",name) AS name_sel'))
                ->orderBy('name_sel')
                ->pluck('name_sel','id')
                ->toarray();
        return $projectPrioritySelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('commercialSelect')){
    function commercialSelect ():array
    {
        try {
            $commercialSelect = Worker::select("id",
            DB::raw('CONCAT(id,"-",name," ",lastname) AS name_sel'))
                ->where('status','=',1)
                ->where('is_commercial','=',1)
                ->orderBy('name_sel')
                ->pluck('name_sel','id');
            return $commercialSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('projectManagerSelect')){
    function projectManagerSelect ():array
    {
        try {
            $projectManagerSelect = DB::table('project_managers')
                ->leftJoin('workers', 'workers.id', '=', 'project_managers.worker_id')
                ->select('project_managers.id',
                    DB::raw('CONCAT(workers.name," ",workers.lastname) AS worker_full_name')
                )
                ->pluck('worker_full_name','id');
            return $projectManagerSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('cronDayOfWeekSlect')){
    function cronDayOfWeekSlect (){
        $cronDayOfWeekSlect = [
            '*' => trans('messages.All'),
            1 => trans('messages.WeekDays.Monday'),
            2 => trans('messages.WeekDays.Tuesday'),
            3 => trans('messages.WeekDays.Wednesday'),
            4 => trans('messages.WeekDays.Thursday'),
            5 => trans('messages.WeekDays.Friday'),
            6 => trans('messages.WeekDays.Saturday'),
            0 => trans('messages.WeekDays.Sunday'),
        ];
        return $cronDayOfWeekSlect;
    }
}


if(!function_exists('cronMonthsSelect')){
    function cronMonthsSelect (){
        $cronMonthsSelect = [
            '*' => trans('messages.All'),
            1 => trans('messages.Months.1'),
            2 => trans('messages.Months.2'),
            3 => trans('messages.Months.3'),
            4 => trans('messages.Months.4'),
            5 => trans('messages.Months.5'),
            6 => trans('messages.Months.6'),
            7 => trans('messages.Months.7'),
            8 => trans('messages.Months.8'),
            9 => trans('messages.Months.9'),
            10 => trans('messages.Months.10'),
            11 => trans('messages.Months.11'),
            12 => trans('messages.Months.12'),
        ];
        return $cronMonthsSelect;
    }
}


if(!function_exists('countrySelect')){
    function countrySelect ():array
    {
        try {
            $countrySelect = Country::All()->sortBy('name')
            ->pluck('name','id')
            ->toarray();
            return $countrySelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('categorySelect')){
    function categorySelect ():array
    {
        try {
            $categorySelect = Category::All()->sortBy('name')
                ->pluck('name','id')
                ->toarray();
            return $categorySelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('vatSelect')){
    function vatSelect ()
    {
        try {
            $vatSelect = Vat::All('id','description')->sortBy('description')
                ->pluck('description','id')
                ->toarray();
            return $vatSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


if(!function_exists('paymentMethodSelect')){
    function paymentMethodSelect ():array
    {
        try {
            $paymentMethodSelect = PaymentMethod::All('id','name')->sortBy('name')
                ->pluck('name','id')
                ->toarray();
            return $paymentMethodSelect;
        } catch (\Throwable $th) {
            return [];
        }

    }
}


if(!function_exists('sidebarMenuFatherSelect')){
    function sidebarMenuFatherSelect ():array
    {
        try {
            $sidebarMenuFatherSelect = SidebarMenuFather::All('id','name')->sortBy('name')
                ->pluck('name','id')
                ->toarray();
            return $sidebarMenuFatherSelect;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
