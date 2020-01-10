<?php

namespace App\Http\Controllers;

use App\ReservationsData;
use Illuminate\Http\Request;
use App\GuestsData;
use App\RoomsData;

class Reservations extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReservationsData::latest()->with('room')->with('guest')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'guest_name' => 'required|string|max:191',
            //'guest_mobile' => 'required|max:14',
            'guest_type' => 'required',
            'guest_number' => 'required',
            'guest_cid' => 'required|date|after:yesterday',
            'guest_cod' => 'required|date|after:yesterday'

        ]);

        $guest = GuestsData::updateOrCreate(
            ['guest_name' => $request['guest_name'], 'guest_number' => $request['guest_number']],
            [
                'guest_mobile' => $request['guest_mobile'],
                'guest_gender' => $request['guest_gender'],
                'guest_lastname' => $request['guest_lastname'],
                'guest_type' => $request['guest_type'],
                'guest_number' => $request['guest_number'],
                'guest_cap' => $request['guest_cap']
            ]
        );

        $room = RoomsData::where('room_number', $request['room_number'])
                   ->update(['room_status' => 'Reserved']);

        $reserve = new ReservationsData([
        'room_number' => $request['room_number'],
        'guest_id' => $guest->guest_id,
        'guest_cap' => $request['guest_cap'],
        'check_in' => $request['guest_cid'],
        'check_out' => $request['guest_cod']
        ]);

        $reserve->save();
        return $guest;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReservationsData  $reservationsData
     * @return \Illuminate\Http\Response
     */
    public function show($res)
    {

        return ReservationsData::where('reservation_id', $res)->with('room')->with('guest')->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservationsData  $reservationsData
     * @return \Illuminate\Http\Response
     * editresid:'',
     * editroom_number: '',
     * editguest_name: '',
     * editguest_cid: '',
     * editguest_cod: '',
     * editguest_cap: '',
     * editguest_mobile: '',
     * editguest_type: '',
     * editguest_number: '',
     */
    public function update(Request $request)
    {
        $res = ReservationsData::find($request['editresid']);
        $res->room_number = $request['editroom_number'];
        $res->guest_cap =   $request['editguest_cap'];
        $res->check_in =    $request['editguest_cid'];
        $res->check_out =   $request['editguest_cod'];
        $res->save();

        $gue = GuestsData::find($request['editguest_id']);
        $gue->guest_name =   $request['editguest_name'];
        $gue->guest_mobile = $request['editguest_mobile'];
        $gue->guest_type =   $request['editguest_type'];
        $gue->guest_number = $request['editguest_number'];
        $gue->save();
        return [$res,$gue];
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
