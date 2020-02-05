<?php

namespace App\Http\Controllers;

use App\ReservationsData;
use Illuminate\Http\Request;
use App\GuestsData;
use App\RoomsData;
use App\Floors;
use App\Rules\hasreservation;
use Illuminate\Validation\ValidationException;
class Reservations extends Controller
{

    public function index()
    {
        return ReservationsData::where('status', '!=', '5')->with('room.rate')->with('guest')->with('payments')->get();
    }

    public function store(Request $request)
    {
        $room = Floors::where('room_type', $request->room['room_type'])->where('room_status', 'Available')->first();
        if($room){
            $this->validate($request,[
                'guest.guest_name' => 'required|string|max:191',
                'guest.guest_mobile' => 'required|max:14',
                'check_in' => ['required', new hasreservation($request->check_out,$room->room_number)]
            ]);
            $room->update(['room_status' => 'Reserved']);
            $guest = new GuestsData;
            $guest->guest_name = $request->guest['guest_name'];
            $guest->guest_lastname = $request->guest['guest_lastname'];
            $guest->guest_email= $request->guest['guest_email'];
            $guest->guest_mobile= $request->guest['guest_mobile'];
            $guest->save();
            $reserve = new ReservationsData;
            $reserve->room_number   = $room->room_number      ;
            $reserve->guest_id      = $guest->guest_id        ;
            $reserve->check_in      = $request->check_in      ;
            $reserve->check_out     = $request->check_out     ;
            $reserve->save();
        }else{

            throw ValidationException::withMessages(['room_type' => 'No room with that type'.$room]);
        }

    }

    public function show($res)
    {

        return ReservationsData::where('reservation_id', $res)->with('room')->with('guest')->first();
    }

    public function update(Request $request)
    {
        $reserve = ReservationsData::find($request['reservation_id']);
        $reserve->room_number   = $request->room_number;
        $reserve->guest_id      = $request->guest_id;
        $reserve->guest_cap     = $request->number_persons;
        $reserve->discount_type = $request->discount_type ;
        $reserve->breakfast     = $request->breakfast     ;
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
        RoomsData::where('room_number', $reservation->room_number)->update(['room_status' => 'Dirty']);
        if ($reservation != null) {
            $reservation->delete();
        }
        return $reservation;
     }
}
