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
    ];

    public function users(){
        return $this->hasMany(User::class, 'userId');
    }

   
    
}
