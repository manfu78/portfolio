<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

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

    public function customerContacts():HasMany
    {
        return $this->hasMany(CustomerContact::class);
    }

    public function opportunities():HasMany
    {
        return $this->hasMany(Opportunity::class);
    }

    public function projects():HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function projectChores():HasMany
    {
        return $this->hasMany(ProjectChore::class);
    }

    public function projectTimes():HasMany
    {
        return $this->hasMany(ProjectTime::class);
    }

    // public function expenses():MorphMany
    // {
    //     return $this->morphMany(Expense::class, 'expenseable');
    // }

    public function incomes():MorphMany
    {
        return $this->morphMany(Income::class, 'incomeable');
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
