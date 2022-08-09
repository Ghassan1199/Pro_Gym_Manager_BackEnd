<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
    ];

    public function sub()
    {
        return $this->belongsTo(subscription::class, 'sub_id');
    }

}
