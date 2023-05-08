<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'responders';
    protected $fillable = [
        'userId',
        'type',
        'unit_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'userId');
    }

    public function response()
    {
        return $this->belongsTo(Response::class, 'responderId');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
