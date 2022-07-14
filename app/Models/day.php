<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class day extends Model
{
    use HasFactory;

    protected $fillable = [
        'sat',
        'sun',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri'
    ];
    public $timestamps = false;

    public function subscription() : BelongsTo
    {
        return $this->belongsTo(subscription::class,'day_id');
    }
}
