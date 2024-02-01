<?php

namespace App\Models\Builders;

use App\Models\ProjectTime;
use Illuminate\Database\Eloquent\Builder;

final class ProjectBuilder extends Builder
{

    final public function withProjetManagers($selectedProjectManagers): self
    {
        // $user = auth()->user();
        if ($selectedProjectManagers!=null) {
            $this->whereHas('projectManagers', function($q) use ($selectedProjectManagers){
                $q->whereIn('project_manager_id',$selectedProjectManagers);
            });
        }
        return $this;
    }

    final public function ganttFilter($departmentSelected,$projectPrioritySelected,$customerSelected,$projectSelected,$projectManagerSelected,$workerSelected): self
    {
        if ($departmentSelected!=null) {
            $this->whereIn('department_id',$departmentSelected);
        }

        if ($projectPrioritySelected!=null) {
            $this->whereIn('project_priority_id',$projectPrioritySelected);
        }

        if ($customerSelected!=null) {
            $this->whereIn('customer_id',$customerSelected);
        }

        if ($projectSelected!=null) {
            $this->whereIn('id',$projectSelected);
        }

        if ($workerSelected!=null&&$workerSelected[0]!='0') {

            $workerProjects = ProjectTime::select('project_id')
            ->where('worker_id','=',$workerSelected)
            ->distinct()
            ->pluck('project_id');

            $this->whereIn('id',$workerProjects);
        }

        if ($projectManagerSelected!=null) {
           $this->whereHas('projectManagers',function (Builder $query) use($projectManagerSelected) {
                $query->whereIn('project_project_manager.project_manager_id', $projectManagerSelected);
            });
        }

        return $this;
    }
}
