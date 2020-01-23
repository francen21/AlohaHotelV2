<?php

namespace App\Http\Controllers;

use App\ReservationsData;
use Illuminate\Http\Request;
use App\GuestsData;
use App\RoomsData;

class Reservations extends Controller
{

    public function index()
    {
        return ReservationsData::latest()->with('room')->with('guest')->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'guest.guest_name' => 'required|string|max:191',
            'guest.guest_mobile' => 'required|max:14',
            'guest.guest_type' => 'required',
            'guest.guest_number' => 'required',
            'check_in' => 'required|date|after:yesterday',
            'check_out' => 'required|date|after:yesterday'
        ]);

        $guest = GuestsData::firstOrNew($request->guest);
        $guest->save();
        $room = RoomsData::where('room_number', $request->room['room_number'])
                   ->update(['room_status' => 'Reserved']);
        $reserve = new ReservationsData;
        $reserve->room_number   = $request->room['room_number'];
        $reserve->guest_id      = $guest->guest_id      ;
        $reserve->guest_cap     = $request->number_persons     ;
        $reserve->discount_type = $request->discount_type ;
        $reserve->breakfast     = $request->breakfast     ;
        $reserve->grace_time    = $request->grace_time    ;
        $reserve->purpose_visit = $request->purpose_visit ;
        $reserve->from          = $request->from          ;
        $reserve->to            = $request->to            ;
        $reserve->number_persons= $request->number_persons;
        $reserve->male_         = $request->male_         ;
        $reserve->female_       = $request->female_       ;
        $reserve->children_     = $request->children_     ;
        $reserve->check_in      = $request->check_in      ;
        $reserve->check_out     = $request->check_out     ;
        $reserve->save();
        return $request;
    }

    public function show($res)
    {

        return ReservationsData::where('reservation_id', $res)->with('room')->with('guest')->first();
    }

    public function update(Request $request)
    {
        $reserve = ReservationsData::find($request['reservation_id']);
        $reserve->room_number   = $request->room_number;
        $reserve->guest_id      = $request->guest_id      ;
        $reserve->guest_cap     = $request->number_persons     ;
        $reserve->discount_type = $request->discount_type ;
        $reserve->breakfast     = $request->breakfast     ;
        $reserve->grace_time    = $request->grace_time    ;
        $reserve->purpose_visit = $request->purpose_visit ;
        $reserve->from          = $request->from          ;
        $reserve->to            = $request->to            ;
        $reserve->number_persons= $request->number_persons;
        $reserve->male_         = $request->male_         ;
        $reserve->female_       = $request->female_       ;
        $reserve->children_     = $request->children_     ;
        $reserve->check_in      = $request->check_in      ;
        $reserve->check_out     = $request->check_out     ;
        $reserve->save();

        $gue = GuestsData::where('guest_id',$request->guest_id)
        ->update($request->guest);
        return $gue;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservationsData  $reservationsData
     * @return \Illuminate\Http\Response
     */
    public function destroy($res)
    {
        //$reservationsData->delete();
        $reservation = ReservationsData::where('reservation_id',$res)->with('room')->first();
        RoomsData::where('room_number', $reservation->room_number)->update(['room_status' => 'Available']);
        if ($reservation != null) {
            $reservation->delete();
        }
        return $reservation;
     }
}
