<?php

namespace App\Http\Controllers;

use App\Floors;
use Illuminate\Http\Request;

class FloorsController extends Controller
{

    public function index()
    {
        return Floors::latest()->with('reservation')->paginate(10);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'room' => 'required|unique:rooms_data'

        ]);

        $room = Floors::updateOrCreate(
            ['room_number' => $request['room_number'],'room_floor' => $request['room_floor']],
            [
                'room_floor' => $request['room_floor'],
                'room_tarrif' => $request['room_tarrif'],
                'room_type' => $request['room_type'],
                'room_status' => 'For Inspection',
                'room_number' => $request['room_number'],

            ]
        );

        return $request;
    }

    public function show($id)
    {
        return Floors::find($id);
    }

    public function update(Request $request)
    {

        $gue = Floors::find($request['room_id']);
        $gue->room_floor =   $request['room_floor'];
        $gue->room_type = $request['room_type'];
        $gue->room_number =   $request['room_number'];
        $gue->room_tarrif = $request['room_tarrif'];
        $gue->room = $request['room_floor'].$request['room_number'];
        $gue->save();
        return $gue;

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
