<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exercies extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'desc'
    ];
    use HasFactory;
    public function subscriptions()
    {
        
        return $this->belongsToMany(subscription::class, 'sub_exe',
            'exercies_id', 'sub_id');
    }
}
