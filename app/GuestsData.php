<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestsData extends Model
{
    public $primaryKey = 'guest_id';
    protected $guarded = [];
    public $timestamps = true;
    public function charges()
    {
        return $this->hasMany('App\charges', 'c_id');
    }
}
