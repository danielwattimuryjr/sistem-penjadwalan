<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $fillable = [
        'name',
        'location'
    ];

    public function availabilities()
    {
        return $this->hasMany(CourtAvailability::class);
    }
}
