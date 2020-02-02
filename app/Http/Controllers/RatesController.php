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
        $rate->type = $request->type;
        $rate->capacity = $request->capacity;
        $rate->rate = $request->rate;
        $rate->save();

    }
    public function update(Request $request)
    {

        $gue = rates::find($request['id']);
        $gue->type =   $request->type;
        $gue->capacity =   $request->capacity;
        $gue->rate =   $request->rate;
        $gue->save();

    }
    public function destroy($id)
    {
        $rate = rates::find($id);
        if ($rate != null) {
            $rate->delete();
        }
        return $id;
    }
}
