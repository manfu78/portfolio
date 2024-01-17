<?php

namespace App\Models;

use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['select_category'];
    protected $fillable = ['name', 'hour_price','unit_price','details','user_id_mod'];

    public function getSelectCategoryAttribute():string
    {
        $selectCategory = $this->name;
        if($this->hour_price!=0){
            $selectCategory = $selectCategory.' ('.$this->hour_price.'€/h)';
        }
        if($this->unit_price!=0){
            $selectCategory = $selectCategory.' ('.$this->unit_price.'€/k)';
        }
        return $selectCategory;
    }

    public function modifiedByUser():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id_mod','id');
    }

    public function delete()
    {
        if ($this->nonDeletableRecord()) {
            throw new ErrorException(trans('messages.InfoError.CanNotBeDeleted'));

        }
        // Si no hay restricciones, realiza la eliminación suave
        parent::delete();
    }

    protected function nonDeletableRecord():bool
    {
        return $this->id === 1;
    }
}
