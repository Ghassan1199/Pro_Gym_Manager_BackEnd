<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'phone_number',
    ];
    protected $hidden=[
        'password'
    ];


    public function gym()
    {
        return $this->belongsTo(gym::class, 'gym_id');
    }

    public function subscription()
    {
        return $this->hasMany(subscription::class, 'coach_id');
    }

    public function contract()
    {
        return $this->hasMany(contract::class, 'coach_id');
    }

    public function qualifications()
    {
        return $this->belongsToMany(qualifications::class, 'coach_qual',
            'coach_id', 'qual_id');
    }

}
