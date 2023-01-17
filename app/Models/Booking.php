<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{



    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
