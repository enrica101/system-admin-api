<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
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
