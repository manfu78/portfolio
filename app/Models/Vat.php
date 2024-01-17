<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    use HasFactory;

    protected $fillable = ['vat', 'surcharge','description','user_id_mod'];

    public function modifiedByUser(){
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
