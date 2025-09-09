<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'date',
        'type',
        'day_of_week',
        'start_time',
        'end_time',
        'court_id'
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'schedule_player')
                    ->withTimestamps();
    }
}
