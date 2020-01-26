<?php

namespace App\Http\Controllers;

use App\rates;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function index()
    {
        return rates::latest()->with('room')->paginate(100);
    }
    public function store(Request $request)
    {

        $rate = new rates;
        $rate->room_type = $request->room_type;
        $rate->rate = $request->rate;
        $rate->save();

    }
    public function update(Request $request)
    {

        $gue = rates::find($request['id']);
        $gue->room_type =   $request->room_type;
        $gue->rate =   $request->rate;
        $gue->save();

    }
    public function destroy($id)
    {
        $rate = rates::find($id)->first();
        if ($rate != null) {
            $rate->delete();
        }
        return $id;
    }
}
