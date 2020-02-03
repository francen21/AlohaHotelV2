<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationsData extends Model
{
    public $primaryKey = 'reservation_id';
    protected $guarded = [];
    public $timestamps = true;
    public function room()
    {
        return $this->belongsTo('App\RoomsData' , 'room_number' , 'room_number');
    }
    public function guest()
    {
        return $this->belongsTo('App\GuestsData', 'guest_id');
    }
    public function payments()
    {
        /* return $this->hasManyThrough(
            'App\Post',
            'App\User',
            'country_id', // Foreign key on users table...
            'user_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        ); */
        return $this->hasManyThrough( 'App\payment', 'App\GuestsData', 'guest_id', 'guest_id', 'guest_id', 'guest_id');
    }
}
