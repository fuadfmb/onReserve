<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'user_id', 'company_id', 'title', 'desc', 'approved',
        'event_start_time', 'event_end_time', 'approved_by',
        'event_deadline',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->hasOne(EventLocation::class);
    }
}
