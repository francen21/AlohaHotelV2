<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $primaryKey = 'inventory_id';
    protected $guarded = [];
    protected $fillable = [
        'item_code',
        'item_category',
        'item_quantity'
    ];
}
