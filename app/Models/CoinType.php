<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinType extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','sign','sign_html','equivalence','default','user_id_mod'];

    public function modifiedByUser(){
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
