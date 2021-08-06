<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'place_id',
        'price',
        'discount',
        'new_price',
        'start_day',
        'end_day',
        'notes',
        'status',
    ];


    public function place(){
        return $this->belongsTo('App\Models\place');
    }
}
