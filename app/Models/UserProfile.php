<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class UserProfile extends Model
{
    use HasFactory;

    protected $appends = ['full_name','full_name_id'];
    protected $guarded = ['id','created_at','updated_at'];

    public function getFullNameAttribute($value){
        return $this->name.' '.$this->lastname;
    }
    public function getFullNameIdAttribute($value){
        $worker = $this->name.' '.$this->lastname;
        $worker = $this->id.'-'.$worker;
        return $worker;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function business():BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    // public function projects():BelongsToMany
    // {
    //     return $this->belongsToMany(Project::class);
    // }

    // public function projectChores():HasMany
    // {
    //     return $this->hasMany(ProjectChore::class);
    // }

    // public function projectsTimes():HasMany
    // {
    //     return $this->hasMany(ProjectTime::class);
    // }

    public function documents():MorphMany
    {
        return $this->morphMany('App\Models\Document','documentable');
    }

    // public function expenses():MorphMany
    // {
    //     return $this->morphMany(Expense::class, 'expenseable');
    // }

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }


    public function getSelectWorkerAttribute()
    {
        $selectWorker = $this->name.' '.$this->lastname;
        $selectWorker = $this->id.'-'.$selectWorker;
        return $selectWorker;
    }

    public function comercialActivities(){
        $regs = $this->user?$this->user->comercialActivities:null;
        return $regs;
    }
}
