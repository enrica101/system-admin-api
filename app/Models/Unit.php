<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $fillable = [
      'title',
      'unit',
      'type',
      'lat',
      'lng'
    ];

   public function responders(){
      return $this->belongsTo(Responder::class, 'unit');
   }
}
