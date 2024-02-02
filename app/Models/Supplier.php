<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Supplier extends Model
{
    use HasFactory;

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function vat():BelongsTo
    {
        return $this->belongsTo(Vat::class);
    }

    public function business(){
        return $this->belongsTo(Business::class);
    }

    public function paymentMethod():BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function supplierContacts():HasMany
    {
        return $this->hasMany(CustomerContact::class);
    }

    public function documents():MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
