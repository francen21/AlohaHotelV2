<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * inventory_id:''
     * item_code:''
     * item_category:''
     * item_quantity:''
     */
    public function index()
    {
        return Inventory::latest()->paginate(10);
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'item_code' => 'required|unique:inventories',
            'item_category' => 'required',
            'item_quantity' => 'required',
        ]);

        $stock = new Inventory;
        $stock->item_code = $request->item_code;
        $stock->item_category = $request->item_category;
        $stock->item_quantity = $request->item_quantity;
        $stock->save();
        return $stock;
    }

    public function update(Request $request)
    {
        $inv = Inventory::find($request['inventory_id']);
        $inv->item_code =      $request['item_code'];
        $inv->item_category =  $request['item_category'];
        $inv->item_quantity =  $request['item_quantity'];
        $inv->save();
        return $inv;
    }

    public function destroy($id)
    {
        Inventory::destroy($id);
        return $id;
    }
}
