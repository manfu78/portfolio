<?php

namespace App\Models;

use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Business extends Model
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

    public function bankAccounts():BelongsToMany
    {
        return $this->belongsToMany(BankAccount::class);
    }

    // public function expenses():MorphMany
    // {
    //     return $this->morphMany(Expense::class, 'expenseable');
    // }

    public function documents():MorphMany
    {
        return $this->morphMany('App\Models\Document','documentable');
    }

    public function delete()
    {
        if ($this->nonDeletableRecord()) {
            throw new ErrorException(trans('messages.InfoError.CanNotBeDeleted'));

        }
        // Si no hay restricciones, realiza la eliminación suave
        parent::delete();
    }

    protected function nonDeletableRecord()
    {
        return $this->id === 1;
    }

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }
}
