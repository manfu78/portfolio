<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContact extends Model
{
    use HasFactory;

    protected $fillable = ['contact', 'phone','email','position','customer_id'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
