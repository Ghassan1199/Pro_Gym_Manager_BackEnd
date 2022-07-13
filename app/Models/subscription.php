<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class subscription extends Model
{
    use HasFactory;


    protected $fillable = [
        'starts_at',
        'ends_at',
        'private',
        'price',
        'paid_amount',
        'fully_paid',
        'coach_id',
        'user_id'
    ];

    public function coach()
    {
        return $this->belongsTo(coach::class, 'coach_id');
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function days(): HasOne
    {
        return $this->hasOne(day::class, 'sub_id');
    }

    public function exercies()
    {
        return $this->belongsToMany(subscription::class, 'sub_exe',
            'sub_id', 'exercies_id');
    }

}
