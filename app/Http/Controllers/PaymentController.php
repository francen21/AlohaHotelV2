<?php

namespace App\Http\Controllers;

use App\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return payment::latest()->paginate(1000);
    }
    public function store(Request $request)
    {

        $rate = new payment;
        $rate->guest_id = $request->guest_id;
        $rate->price = $request->price;
        $rate->save();

    }
    public function update(Request $request)
    {

        $rate = payment::find($request['id']);
        $rate->guest_id = $request->guest_id;
        $rate->price = $request->price;
        $rate->save();

    }
    public function destroy($id)
    {
        $rate = payment::find($id)->first();
        if ($rate != null) {
            $rate->delete();
        }
        return $id;
    }
}
