<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exercies extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'desc',
        'sub_id'
    ];
    use HasFactory;

    public function subscription()
    {

        return $this->belongsTo(subscription::class, 'sub_id');
    }
}
