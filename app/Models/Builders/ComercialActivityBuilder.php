<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

final class ComercialActivityBuilder extends Builder
{
    final public function filter($fromDate,$toDate,$words,$selectedComercialActivityTypes,$selectedUsers,$selectedModel): self
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

        if ($selectedModel!=null) {
            $this->where('comercial_activityable_type','=',$selectedModel);
        }

        if ($selectedComercialActivityTypes!=null) {
            $this->whereIn('comercial_activity_type_id',$selectedComercialActivityTypes);
        }

        if ($selectedUsers!=null) {
            $this->whereIn('crated_by_user_id',$selectedUsers);
        }

        if ($words!=null) {
            foreach ($words as $word) {
                $this->where(column: 'name', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'channel', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'observations', operator: 'LIKE', value: '%'.$word.'%');
            }
        }

        return $this;
    }

    final public function byWorkers($userSelects): self
    {

        if ($userSelects!=null) {
            $this->whereIn('crated_by_user_id',$userSelects);
        }

        return $this;
    }

}
