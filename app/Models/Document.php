<?php

namespace App\Models;

use App\Models\Builders\DocumentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Tags\HasTags;

class Document extends Model
{
    use HasFactory,HasTags;

    protected $guarded = ['id','created_at','updated_at'];

    public function newEloquentBuilder($query): Builder
    {
        return new DocumentBuilder($query);
    }

    public function documentable():MorphTo
    {
        return $this->morphTo();
    }

    public function documentType():BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }

    public function getModel():string
    {
        $documentableModelArray = explode('\\',$this->documentable_type);
        $model = $documentableModelArray[2];
        return $model;
    }

    public function getModelName():string
    {
        //class_basename($model)
        $documentableModelArray = explode('\\',$this->documentable_type);
        $model = $documentableModelArray[2];
        $langModel = trans('messages.'.$model.'.'.$model);
        return $langModel;
    }

    public function getRoute()
    {
        $routes = routeables();
        if (array_key_exists($this->documentable_type,$routes)) {
            $route = route($routes[$this->documentable_type],$this->documentable_id);
            return $route;
        }
        return null;
    }
}
