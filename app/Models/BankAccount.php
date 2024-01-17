<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BankAccount extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function businesses():BelongsToMany
    {
        return $this->belongsToMany(Business::class);
    }

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
