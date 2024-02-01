<?php

namespace App\Models\Builders;

use App\Models\Document;
use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Builder;

final class DocumentBuilder extends Builder
{

    final public function filter(
        $fromDate,
        $toDate,
        $documentTypeSelected,
        $businessSelected,
        $customerSelected,
        $workerSelected,
        $projectSelected,
        $projectChoreSelected,
        $opportunitySelected,
        $words,

    ): self
    {
        if ($fromDate!=null) {
            $fromDate = $fromDate.' 00:00:00';
            $this->where('documents.created_at','>=',$fromDate);
        }

        if ($toDate!=null) {
            $toDate = $toDate.' 23:59:59';
            $this->where('documents.created_at','<=',$toDate);
        }

        if ($documentTypeSelected!=null) {
            $this->where('document_type_id','=',$documentTypeSelected);
        }

        if ($businessSelected!=null) {
            $this->where('business_id','=',$businessSelected);
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

        if ($words!=null) {
            $opportunityIdArray = Document::withAnyTag($words)->pluck('id');
            foreach ($words as $word) {
                $this->where(column: 'name', operator: 'LIKE', value: '%'.$word.'%');
                $this->orWhere(column: 'description', operator: 'LIKE', value: '%'.$word.'%');
            }
            $this->orWhereIn('id',$opportunityIdArray);
        }

        $this->orderBy('date','desc');

        return $this;
    }
}
