<?php

namespace App\Http\Controllers;

use App\ReservationsData;
use Illuminate\Http\Request;
use App\GuestsData;
use App\RoomsData;
use App\Rules\hasreservation;
class Reservations extends Controller
{

    public function index()
    {
        return ReservationsData::orderBy('check_in')->where('status', '!=', '5')->with('room.rate')->with('guest.payments')->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'guest.guest_name' => 'required|string|max:191',
            'guest.guest_mobile' => 'required|max:14',
            'guest.guest_type' => 'required',
            'guest.guest_number' => 'required',
            'check_in' => ['required', new hasreservation($request->check_out,$request->room['room_number'])]
        ]);
        $guest = new GuestsData;
        $guest->guest_tittle = $request->guest['guest_tittle'];
        $guest->guest_name = $request->guest['guest_name'];
        $guest->guest_lastname = $request->guest['guest_lastname'];
        $guest->guest_gender= $request->guest['guest_gender'];
        $guest->guest_address= $request->guest['guest_address'];
        $guest->guest_city= $request->guest['guest_city'];
        $guest->guest_country= $request->guest['guest_country'];
        $guest->guest_email= $request->guest['guest_email'];
        $guest->guest_mobile= $request->guest['guest_mobile'];
        $guest->guest_type= $request->guest['guest_type'];
        $guest->guest_number= $request->guest['guest_number'];
        $guest->guest_remarks= $request->guest['guest_remarks'];
        $guest->guest_checkin_points= $request->guest['guest_checkin_points'];
        $guest->guest_balance= $request->guest['guest_balance'];
        $guest->howFind= $request->guest['howFind'];
        $guest->save();
       $room = RoomsData::where('room_number', $request->room['room_number'])
                  ->update(['room_status' => 'Reserved']);
       $reserve = new ReservationsData;
       $reserve->room_number   = $request->room['room_number'];
       $reserve->guest_id      = $guest->guest_id           ;
       $reserve->guest_cap     = $request->number_persons     ;
       $reserve->discount_type = $request->discount_type ;
       $reserve->breakfast     = $request->breakfast     ;
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
