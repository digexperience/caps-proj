<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_sched_id', 'time_slot', 'day', 'section', 'room',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_sched_id');
    }
}
