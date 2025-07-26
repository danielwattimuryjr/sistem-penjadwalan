<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledSession extends Model
{
    protected $fillable = [
        'time_slot_id',
        'court_id',
        'session_type',
    ];

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }

    protected $with = ['timeSlot', 'court'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
