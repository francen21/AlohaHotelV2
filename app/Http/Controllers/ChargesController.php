<?php

namespace App\Http\Controllers;

use App\charges;
use Illuminate\Http\Request;

class ChargesController extends Controller
{
    public function store(Request $request)
    {

        $charge = new charges;
        $charge->room_id = $request->room_id;
        $charge->guest_id = $request->guest_id;
        $charge->code= $request->code;
        $charge->category= $request->category;
        $charge->qty= $request->qty;
        $charge->price= $request->price;
        $charge->save();
        return $request;

    }

    public function show($id)
    {
        return charges::where('room_id',$id)->with('stock')->get();
    }

    public function update(Request $request)
    {

        $charge = charges::find($request->id);
        $charge->room_id = $request->room_id;
        $charge->guest_id = $request->guest_id;
        $charge->code= $request->code;
        $charge->qty= $request->qty;
        $charge->price= $request->price;
        $charge->save();
        return $request;

    }

    public function destroy($id)
    {
        charges::destroy($id);
    }
}
