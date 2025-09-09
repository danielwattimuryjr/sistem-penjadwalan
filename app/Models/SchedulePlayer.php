<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SchedulePlayer extends Pivot
{
    protected $table = 'schedule_player';

    protected $fillabel = [
        'schedule_id',
        'player_id'
    ];
}
