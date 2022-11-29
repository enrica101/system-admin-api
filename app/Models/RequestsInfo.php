<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsInfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'requests_infos';
    protected $fillable = [
        'userId',
        'type',
        'location',
        'lat',
        'lng',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'userId');
    }


}
