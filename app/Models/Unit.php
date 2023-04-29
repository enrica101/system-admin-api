<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Unit extends Model{

    use HasFactory;

    protected $table = 'units';
    protected $fillable = [
        
      'name',
      'type',
    ];

   public function responders(){
      return $this->hasMany(Responder::class, 'unit');
   }

}