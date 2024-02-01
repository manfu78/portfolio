<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFavorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','sidebar_menu_item_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sidebarMenuItem():BelongsTo
    {
        return $this->belongsTo(SidebarMenuItem::class);
    }
}
