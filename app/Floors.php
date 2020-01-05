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
        'room_status',
        'room_number'
    ];
}