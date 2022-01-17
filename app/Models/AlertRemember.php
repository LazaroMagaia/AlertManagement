<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MessageAlert;
use App\Models\User;
class AlertRemember extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'date_start',
        'date_finish',
    ];
    public function MessageAlert()
    {
        return ($this->hasOne(MessageAlert::class));
    }
    public function User()
    {
        $this->belongsTo(User::class);
    }
}
