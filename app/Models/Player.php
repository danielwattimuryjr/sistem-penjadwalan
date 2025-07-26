<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name',
        'position',
        'jersey_number'
    ];

    public function availabilities()
    {
        return $this->hasMany(PlayerAvailability::class);
    }

    public function scheduledSessions()
    {
        return $this->belongsToMany(ScheduledSession::class);
    }
}
