<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Polygon extends Model{
    use HasFactory, SoftDeletes;

    protected $table = 'polygons';
    protected $fillable = [
        'lat',
        'lng'
    ];


    public function unit(){
        return $this->belongsTo(Unit::class, 'unit');
    }
}
