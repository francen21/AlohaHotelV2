<?php

namespace App\Http\Controllers;

use App\RoomsData;
use App\Floors;
use Illuminate\Http\Request;

class Rooms extends Controller
{
    public function index()
    {
        return Floors::latest()->with('reservation')->with('charges')->paginate(10);
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
        $gue = Floors::find($request['room_id']);
        $gue->room_status = 'Occupied';
        $gue->save();
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
