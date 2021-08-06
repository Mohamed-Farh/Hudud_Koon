<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chemical extends Model
{
    protected $table = 'chemical';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'place_zoom',
        'region',
        'address',
        'phone',
        'customer_name',
        'email',
        'customer_phone',
        'link',
        'status',

    ];
}
