<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtAvailability extends Model
{
    protected $fillable = [
        'court_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];
    
    public function player()
    {
        return $this->belongsTo(Court::class);
    }
}
