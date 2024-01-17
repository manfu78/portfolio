<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class AppModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'namespace'];

    public function permissions():HasMany
    {
        return $this->hasMany(Permission::class);
    }

    // public function appPermissions():HasMany
    // {
    //     return $this->hasMany(AppPermission::class);
    // }

    public function sidebarMenu():BelongsTo
    {
        return $this->belongsTo(SidebarMenuItem::class);
    }

}
