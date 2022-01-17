<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReciveEmailsToken;
class ReciveEmails extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_message_alert',
        'email',
        'name',
        'token',
        'status',
    ];
    public function ReciveEmailsToken()
    {
        return ($this->hasOne(ReciveEmailsToken::class));
    }
}
