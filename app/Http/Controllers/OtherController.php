<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Floors;
use App\ReservationsData;
class OtherController extends Controller
{
    public function checkout(Request $request)
    {
        $reserve = ReservationsData::find($request['id']);
        $reserve->status      = '5';
        $reserve->save();
        Floors::where('room_number', $reserve->room_number)->update(['room_status' => 'Dirty']);
    }
}
