<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class payment extends Model
{
    use SoftDeletes;
    public $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
    public function guest()
    {
        return $this->hasOne('App\Floors', 'guest_id', 'guest_id');
    }
}
