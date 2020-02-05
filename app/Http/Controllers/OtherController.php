<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floors;
use App\ReservationsData;
class OtherController extends Controller
{
    public function checkout(Request $request)
    {
        $reserve = ReservationsData::find($request['id']);
        $reserve->status      = '5';
        $reserve->save();
        Floors::where('room_number', $reserve->room_number)->update(['room_status' => 'Dirty']);
    }
    public function changeroom(Request $request)
    {
        $reserve = ReservationsData::find($request['id']);
        $reserve->room_number = $request->new_roomnumber;
        $reserve->save();
        Floors::where('room_number', $request->new_roomnumber)->update(['room_status' => 'Occupied']);
        Floors::where('room_number', $request->old_roomnumber)->update(['room_status' => 'For Inspection']);
    }
    public function roomstatus(Request $request)
    {
        Floors::find($request->room_id)->update(['room_status' => $request->room_status]);
    }
    public function reports()
    {
        ReservationsData::latest()->with('room.rate')->with('guest')->with('payments')->get();
    }

}
