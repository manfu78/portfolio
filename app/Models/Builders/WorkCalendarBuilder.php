<?php

namespace App\Models\Builders;

use App\Models\WorkCalendar;
use Illuminate\Database\Eloquent\Builder;

final class WorkCalendarBuilder extends Builder
{
    final public function filter($business,$year): self
    {
        if ($business!=null) {
            $this->where('business_id','=',$business);
        }

        if ($year!=null) {
            $this->whereYear('start',$year);
        }

        return $this;
    }
}
