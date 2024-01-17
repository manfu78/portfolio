<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','sidebar_menu_item_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sidebarMenuItem(){
        return $this->belongsTo(SidebarMenuItem::class);
    }
}
