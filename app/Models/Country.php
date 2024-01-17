<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'iso1','iso2','name'];

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
