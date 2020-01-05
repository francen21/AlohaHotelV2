<?php

namespace App\Http\Controllers;

use App\RoomsData;
use App\Floors;
use Illuminate\Http\Request;

class Rooms extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Floors::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomsData  $roomsData
     * @return \Illuminate\Http\Response
     */
    public function show(RoomsData $roomsData)
    {
        return Floors::where('room_id', $floors)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomsData  $roomsData
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomsData $roomsData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomsData  $roomsData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomsData $roomsData)
    {
        $this->validate($request,[
            //'room' => 'required|unique:rooms_data'
        ]);

        $gue = Floors::find($request['room_id']);
        $gue->room_floor =   $request['room_floor'];
        $gue->room_type = $request['room_type'];
        $gue->room_number =   $request['room_number'];
        $gue->room_tarrif = $request['room_tarrif'];
        $gue->room = $request['room_floor'].$request['room_number'];
        $gue->save();

        return $gue;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomsData  $roomsData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Floors::where('room_id',$id)->first();

        if ($room != null) {
        $room->delete();
        }
        return $id;
    }
}
