<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','sidebar_menu_start_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sidebarMenuStart(){
        return $this->belongsTo(SidebarMenuItem::class,'sidebar_menu_start_id','id');
    }
}
