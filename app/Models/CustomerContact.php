<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;

    protected $fillable = ['contact', 'phone','email','position','customer_id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
