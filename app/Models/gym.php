<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gym extends Model
{

    protected $fillable = [
        'title',
        'address',
        'logo_url'
    ];
    use HasFactory;

    public function coaches()
    {
        return $this->hasMany(coach::class, 'gym_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'gym_id');
    }

    public function admin()
    {
        return $this->belongsTo(admin::class, 'admin_id');
    }
}
