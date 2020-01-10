<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestsData extends Model
{
    public $primaryKey = 'guest_id';
    protected $guarded = [];
    protected $fillable = [
        'guest_name',
        'guest_lastname',
        'guest_mobile',
        'guest_type',
        'guest_number',
        'guest_checkin_points',
        'guest_balance'
    ];
}
