<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floors extends Model
{
    //
    protected $primaryKey = 'room_id';
    protected $table = 'rooms_data';
    protected $fillable = [
        'room_floor',
        'room_type',
        'room',
        'room_status',
        'room_number',
        'room_tarrif'
    ];

    public function reservation()
    {
        return $this->hasMany('App\ReservationsData', 'room_number', 'room_number');
    }
    public function charges()
    {
        return $this->hasMany('App\charges', 'room_id', 'room_id');
    }

}
