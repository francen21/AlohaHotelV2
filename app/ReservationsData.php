<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationsData extends Model
{
    public $primaryKey = 'reservation_id';
    protected $guarded = [
        'reservation_id'
    ];
    protected $fillable = [
        'room_number',
        'guest_id',
        'guest_cap',
        'check_in',
        'check_out'
    ];
    public function room()
    {
        return $this->belongsTo('App\RoomsData' , 'room_number' , 'room_number');
    }
    public function guest()
    {
        return $this->belongsTo('App\GuestsData', 'guest_id');
    }

}
