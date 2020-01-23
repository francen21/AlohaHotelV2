<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomsData extends Model
{
    public $primaryKey = 'room_id';
    protected $guarded = [];
    public function reservation()
    {
        return $this->hasOne('App\ReservationsData', 'room_number', 'room_number');
    }
    public function charges()
    {
        return $this->hasMany('App\charges', 'room_id');
    }
}
