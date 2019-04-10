<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationSchedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'station_id',
        'day',
        'date',
        'open_from',
        'open_till',
        'lunch_start',
        'lunch_end',
        'is_closed'
    ];
}
