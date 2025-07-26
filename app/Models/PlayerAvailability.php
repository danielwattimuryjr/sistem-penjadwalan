<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerAvailability extends Model
{
    protected $fillable = [
        'player_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];
    
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
