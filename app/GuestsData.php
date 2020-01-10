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
        'guest_gender',
        'guest_genderaddress',
        'guest_city',
        'guest_country',
        'guest_email',
        'guest_mobile',
        'guest_remarks',
        'guest_type',
        'guest_number',
        'guest_checkin_points',
        'guest_balance'
    ];
}
