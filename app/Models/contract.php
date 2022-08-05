<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary',
        'start_date',
        'end_date',
        'coach_id'
    ];

    public function coach()
    {
        return $this->belongsTo(coach::class, 'coach_id');
    }
}
