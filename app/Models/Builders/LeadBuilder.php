<?php

namespace App\Models\Builders;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder;

final class LeadBuilder extends Builder
{
    final public function filter($fromDate,$toDate,$words,$leadTypes,$users): self
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

        if ($leadTypes!=null) {
            $this->whereIn('lead_type_id',$leadTypes);
        }

        if ($users!=null) {
            $this->whereIn('user_id',$users);
        }

        if ($words!=null) {
            $leadIdArray = Lead::withAnyTag($words)->pluck('id');
            foreach ($words as $word) {
                $this->where(column: 'name', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'phone', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'email', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'business_name', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'interest', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'observations', operator: 'LIKE', value: '%'.$word.'%');
            }
            $this->orWhereIn('id',$leadIdArray);

        }

        return $this;
    }

}
