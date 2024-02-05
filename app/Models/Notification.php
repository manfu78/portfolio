<?php

namespace App\Models;

use App\Mail\NotificationMailable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function senderUser():BelongsTo
    {
        return $this->belongsTo(User::class,'sender_user_id','id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function worker()
    {
        $worker = $this->user()->worker();
        return $worker;
    }

    public function sendEmail()
    {
        $user = $this->user;
        try {
            Mail::to($user->email)->send(new NotificationMailable($this));
        } catch (\Throwable $th) {
            Log::error("Send Email Error. " . $th->getMessage(), array('notification' => $this));
            return false;
        }
        return true;
    }
}
