<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $table = 'vaccine_centers';

    protected $fillable = [
        'name',
        'capacity',
        'address',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scheduledUsers()
    {
        return $this->hasMany(User::class)->where('status', 'scheduled');
    }
}
