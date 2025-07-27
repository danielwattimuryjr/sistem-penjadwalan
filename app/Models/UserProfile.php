<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'nomor_telepon',
        'jenis_kelamin',
        'tanggal_lahir'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
