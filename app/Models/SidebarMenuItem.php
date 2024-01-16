<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'permission',
        'order',
        'sidebar_menu_father_id',
        'sidebar_menu_sub_father_id',
        'app_model_id',
    ];

    public function sidebarMenuFather(){
        return $this->belongsTo(SidebarMenuFather::class);
    }

    public function sidebarMenuSubFather(){
        return $this->belongsTo(SidebarMenuSubFather::class);
    }

}
