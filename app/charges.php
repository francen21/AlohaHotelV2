<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class charges extends Model
{
    public $primaryKey = 'id';
    protected $guarded = [];
    public function guest()
    {
        return $this->belongsTo('App\GuestData', 'guest_id');
    }
    public function stock()
    {
        return $this->belongsTo('App\Inventory', 'code' , 'item_code');
    }
    public function room()
    {
        return $this->belongsTo('App\RoomsData', 'room_id');
    }
    public function payments()
    {
        return $this->hasMany('App\payment', 'pay_id');
    }
}
