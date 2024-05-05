<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'sport_id',
        'location_id',
        'day',
        'start_time',
        'end_time',
        'price',
        'round'
    ];

    public function sport() {
        return $this->belongsTo(Sport::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function spectators()
    {
        return $this->hasMany(Spectator::class);
    }

}
