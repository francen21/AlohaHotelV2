<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsData extends Model
{
    public $primaryKey = 'room_id';
    public function reservation()
    {
        return $this->hasMany('App\ReservationsData', 'room_id', 'room_id');
    }
}
