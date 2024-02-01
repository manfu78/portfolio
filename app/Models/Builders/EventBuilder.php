<?php

namespace App\Models\Builders;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;

final class EventBuilder extends Builder
{
    final public function filter($workers,$resources): self
    {
        $user = auth()->user();
        $worker= $user->worker;

        if ($workers!=null) {
            $this->whereHas('workers', function ($query) use ($workers) {
                $query->whereIn('worker_id', $workers);
            });
        }

        if ($resources!=null) {
            $this->whereHas('resources', function ($query) use ($resources) {
                $query->whereIn('resource_id', $resources);
            });
        }

        if ($worker!=null) {
            $this->orWhere('host_worker_id','=',$worker->id);
        }


        return $this;
    }
}
