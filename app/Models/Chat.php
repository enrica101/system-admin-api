<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'chats';
    protected $fillable = [
        'requestId',
        'userId',
        'responderId',
        'message',
        'fromRequestor',
    ];
}
