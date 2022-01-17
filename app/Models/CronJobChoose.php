<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronJobChoose extends Model
{
    use HasFactory;
    protected $fillable = [
        'time',
        'id_messages',
    ];
}
