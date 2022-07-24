<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class coach extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'birthday',
        'phone_number',
        'img_url'
    ];
    protected $hidden = [
        'password'
    ];

    protected $primaryKey = "id";

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
        return $this->belongsToMany(
            qualifications::class,
            'coach_quals',
            'coach_id',
            'qual_id'
        );
    }

    public function Users()
    {
        return $this->hasManyThrough(User::class, subscription::class, 'coach_id', 'id');
    }
}
