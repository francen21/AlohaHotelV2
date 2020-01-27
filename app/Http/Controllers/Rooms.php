<?php

namespace App\Http\Controllers;

use App\RoomsData;
use App\ReservationsData;
use App\Floors;
use Illuminate\Http\Request;

class Rooms extends Controller
{
    public function index()
    {
        return Floors::latest()->with('reservation')->with('charges')->paginate(100);
    }
    public function store($request)
    {
        $room = Floors::updateOrCreate(
            ['room_number' => $request['room_number'],'room_floor' => $request['room_floor']],
            [
                'room_status' => $request['room_status'],
            ]
        );

        return $request;
    }
    public function show(RoomsData $roomsData)
    {
        return Floors::where('room_id', $floors)->first();
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'check_in' => 'required|date'
        ]);
        $gue = ReservationsData::where('room_number' , $request->room['room_number'])
        ->update(['status' => '2']);
        $room = Floors::where('room_number', $request->room['room_number'])
        ->update(['room_status' => 'Occupied']);

    }
    public function destroy($id)
    {
        $room = Floors::where('room_id',$id)->first();
        if ($room != null) {
            $room->delete();
        }
        return $id;
    }
}
