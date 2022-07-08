<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class admin extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'gym_id'
    ];
    protected $hidden=[
        'password'
    ];

    protected $primaryKey = "id";

    public function gym() : HasOne
    {
        return $this->hasOne(gym::class, 'admin_id');
    }
}
