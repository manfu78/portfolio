<?php

namespace App\Models\Builders;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Builder;

final class OpportunityBuilder extends Builder
{
    final public function filter($fromDate,$toDate,$words,$selectedOpportunityPhases,$selectedUsers): self
    {
        // $type = auth()->user();

        if ($fromDate!=null) {
            $fromDate = $fromDate.' 00:00:00';
            $this->where('created_at','>=',$fromDate);
        }

        if ($toDate!=null) {
            $toDate = $toDate.' 23:59:59';
            $this->where('created_at','<=',$toDate);
        }

        if ($selectedOpportunityPhases!=null) {
            $this->whereIn('opportunity_phase_id',$selectedOpportunityPhases);
        }

        if ($selectedUsers!=null) {
            $this->whereIn('user_id',$selectedUsers);
        }

        if ($words!=null) {
            $opportunityIdArray = Opportunity::withAnyTag($words)->pluck('id');
            foreach ($words as $word) {
                $this->where(column: 'name', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'channel', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'observations', operator: 'LIKE', value: '%'.$word.'%');
            }
            $this->orWhereIn('id',$opportunityIdArray);

        }

        return $this;
    }

    final public function byWorkers($userSelects): self
    {

        if ($userSelects!=null) {
            $this->whereIn('opportunities.user_id',$userSelects);
        }

        return $this;
    }

}
