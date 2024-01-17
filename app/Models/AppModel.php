<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class AppModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'namespace'];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

    // public function appPermissions(){
    //     return $this->hasMany(AppPermission::class);
    // }

    public function sidebarMenu(){
        return $this->belongsTo(SidebarMenuItem::class);
    }

}
