<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class occu extends Model
{
    public $primaryKey = 'id';
    protected $fillable = [
        'occupancy',
        'adjustment',
    ];
}
