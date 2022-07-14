<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;


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
}
