<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qualifications extends Model
{
    use HasFactory;

    protected $fillable=[
        'title'
    ];

    public function coaches()
    {
        return $this->belongsToMany(qualifications::class, 'coach_quals',
            'qual_id', 'coach_id');
    }
}
