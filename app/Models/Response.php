<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestId',
        'responderId',
        'location',
        'lat',
        'lng',
        'status',
    ];

    public function requests_infos(){
        return $this->belongsTo(RequestsInfo::class, 'requestId');
    }

    public function responders(){
        return $this->belongsTo(Responder::class, 'responderId');
    }
}  
