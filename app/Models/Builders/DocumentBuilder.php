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
        $modelSelected,
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

        if ($modelSelected!=null) {
            $this->where('documentable_type','=',$modelSelected);
        }

        // if ($businessSelected!=null) {
        //     $this->where('business_id','=',$businessSelected);
        // }

        // if ($businessSelected!=null) {
        //     $this->whereHas('documentable', function ($query) use ($businessSelected) {
        //         $query->where('id', $businessSelected)->where('documentable_type', 'App\\Business');
        //     });
        // }


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
