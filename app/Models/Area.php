<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','business_id','user_id_mod'];

    public function departments():BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

    public function business():BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function modifiedByUser(){
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
