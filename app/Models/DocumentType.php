<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = ['type','user_id_mod'];

    public function modifiedByUser(){
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
