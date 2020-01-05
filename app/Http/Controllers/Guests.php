<?php

namespace App\Http\Controllers;

use App\GuestsData;
use Illuminate\Http\Request;

class Guests extends Controller
{

    public function index()
    {
        return GuestsData::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'guest_name' => 'required|unique:guests_data',
            'guest_type' => 'required',
            'guest_number' => 'required',
        ]);

        $guest = new GuestsData;
        $guest->guest_name           = $request->guest_name          ;
        $guest->guest_mobile         = $request->guest_mobile        ;
        $guest->guest_type           = $request->guest_type          ;
        $guest->guest_number         = $request->guest_number        ;
        $guest->guest_checkin_points = $request->guest_checkin_points;
        $guest->guest_balance        = $request->guest_balance       ;
        $guest->save();
        return $guest;
    }

    public function show($id)
    {
        return GuestsData::find($id);
    }

    public function update(Request $request)
    {
        $guest = GuestsData::find($request->guest_id);
        $guest->guest_name           = $request->guest_name          ;
        $guest->guest_mobile         = $request->guest_mobile        ;
        $guest->guest_type           = $request->guest_type          ;
        $guest->guest_number         = $request->guest_number        ;
        $guest->guest_checkin_points = $request->guest_checkin_points;
        $guest->guest_balance        = $request->guest_balance       ;
        $guest->save();
        return $guest;
    }

    public function destroy($id)
    {
        GuestsData::destroy($id);
        return $id;
    }
}
