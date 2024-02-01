<?php

namespace App\Models\Builders;

use App\Models\Income;
use Illuminate\Database\Eloquent\Builder;

final class IncomeBuilder extends Builder
{
    final public function filter(
        $fromDate,
        $toDate,
        $customerSelected,
        $workerSelected,
        $projectSelected,
        $projectChoreSelected,
        $opportunitySelected
    ): self
    {

        if ($fromDate!=null) {
            $fromDate = $fromDate.' 00:00:00';
            $this->where('created_at','>=',$fromDate);
        }

        if ($toDate!=null) {
            $toDate = $toDate.' 23:59:59';
            $this->where('created_at','<=',$toDate);
        }

        if ($customerSelected!=null) {
            $this->where('customer_id','=',$customerSelected);
        }

        if ($workerSelected!=null) {
            $this->where('worker_id','=',$workerSelected);
        }

        if ($projectSelected!=null) {
            $this->where('project_id','=',$projectSelected);
        }

        if ($projectChoreSelected!=null) {
            $this->where('project_chore_id','=',$projectChoreSelected);
        }

        if ($opportunitySelected!=null) {
            $this->where('opportunity_id','=',$opportunitySelected);
        }

        $this->orderBy('created_at','desc');

        return $this;
    }

}
