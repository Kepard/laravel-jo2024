<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spectator extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'competition_id',
        'first_name',
        'last_name',
        'phone_number',
        'email',
    ];

    public function competition() {
        return $this->belongsTo(Competition::class);
    }
}
