<?php

namespace App\Http\Controllers;

use App\occu;
use Illuminate\Http\Request;

class OccuController extends Controller
{

    public function index()
    {
        return occu::latest()->paginate(10);
    }
    public function store(Request $request)
    {
        $room = new occu(
            [
                'occupancy' => $request['occupancy'],
                'adjustment' => $request['adjustment'],
            ]
        );
        $room->save();
    }
    public function show(occu $occu)
    {
        return occu::where('room_id', $floors)->first();
    }
    public function update(Request $request)
    {
        $gue = occu::find($request['occu_id']);
        $gue->occupancy =   $request['occupancy'];
        $gue->adjustment =   $request['adjustment'];
        $gue->save();
    }
    public function destroy($id)
    {
        $room = occu::where('id',$id)->first();

        if ($room != null) {
            $room->delete();
        }
    }
}
