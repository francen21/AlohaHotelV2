<?php

namespace App\Http\Controllers;

use App\Floors;
use Illuminate\Http\Request;

class FloorsController extends Controller
{

    public function index()
    {
        return Floors::orderBy('room')->with('reservation.guest')->with('reservation')->with('rate')->paginate(1000);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'room' => 'required|unique:rooms_data',
            'room_tarrif' => 'required'

        ]);

        $room = Floors::updateOrCreate(
            ['room_number' => $request['room_number'],'room_floor' => $request['room_floor']],
            [
                'room_floor' => $request['room_floor'],
                'room' => $request['room_floor'].$request['room_number'],
                'room_type' => $request['room_type'],
                'room_status' => 'For Inspection',
                'room_number' => $request['room_number'],

            ]
        );

        return $room;
    }

    public function show($id)
    {
        return Floors::find($id);
    }

    public function update(Request $request)
    {

        $gue = Floors::find($request->room_id);
        $gue->room_floor =   $request->room_floor;
        $gue->room_type = $request->room_type;
        $gue->room_number =   $request->room_number;
        $gue->room = $request->room_floor.$request->room_number;
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
