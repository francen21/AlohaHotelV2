<?php

namespace App\Http\Controllers;

use App\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return payment::latest()->paginate(10);
    }

    public function store(Request $request)
    {

        //$this->validate($request,[
        //    'item_code' => 'required|unique:inventories',
        //    'item_category' => 'required',
        //    'item_quantity' => 'required',
        //]);

        //$stock = new payment();
        //$stock->save();
        return $request;
    }

    public function update(Request $request)
    {
        //$inv = payment::find();
        return $request;
    }

    public function destroy($id)
    {
        //payment::destroy($id);
        return $id;
    }
}
