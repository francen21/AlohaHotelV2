<?php

namespace App\Http\Controllers;

use App\RoomsData;
use App\ReservationsData;
use App\Floors;
use App\GuestsData;
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
        /*
        guest: new Form({
        guest_id                :'',
        guest_name              :'',
        guest_lastname          :'',
        guest_gender            :'',
        guest_address           :'',
        guest_city              :'',
        guest_country           :'',
        guest_email             :'',
        guest_mobile            :'',
        guest_type              :'',
        guest_number            :'',
        guest_remarks           :'',
        guest_checkin_points    :'',
        guest_balance           :'',
        howFind                 :''
        */

        $room = Floors::where('room_number', $request->room['room_number'])
        ->update(['room_status' => 'Occupied']);

        GuestsData::find($request->guest_id)
        ->update([
            'guest_name' => $request->guest['guest_name'],
            'guest_lastname' => $request->guest['guest_lastname'],
            'guest_gender' => $request->guest['guest_gender'],
            'guest_address' => $request->guest['guest_address'],
            'guest_city' => $request->guest['guest_city'],
            'guest_country' => $request->guest['guest_country'],
            'guest_email' => $request->guest['guest_email'],
            'guest_mobile' => $request->guest['guest_mobile'],
            'guest_type' => $request->guest['guest_type'],
            'guest_number' => $request->guest['guest_number'],
            'guest_remarks' => $request->guest['guest_remarks'],
            'guest_checkin_points' => $request->guest['guest_checkin_points'],
            'guest_balance' => $request->guest['guest_balance'],
            'howFind' => $request->guest['howFind']
        ]);


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
