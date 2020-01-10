<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservationsData;
use App\RoomsData;

class Foservices extends Controller
{
    public function update(Request $request)
    {
        $res = ReservationsData::find($request['reservation_id']);
        RoomsData::where('room_number', $res->room_number)->update(['room_status' => 'Available']);
        $res->room_number = $request['room_number'];
        RoomsData::where('room_number',  $request['room_number'])->update(['room_status' => 'Reserved']);
        $res->save();

    }
}
