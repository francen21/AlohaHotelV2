<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rates extends Model
{
    public $primaryKey = 'id';
    protected $guarded = [];
    protected $table = 'rates';
    public function room()
    {
        return $this->belongsTo('App\RoomsData' , 'room_type' , 'type');
    }
    public function occu(){
        return $this->hasMany('App\occu');
    }
}
