<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReciveEmails;
class MessageAlert extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_alert_remember',
        'subject',
        'message',
    ];
    public function ReciveEmails()
    {
        return ($this->hasMany(ReciveEmails::class));
    }
}
