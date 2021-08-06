<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    protected $table = 'join';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'id_number',
        'phone',
        'address',
        'bank_code',
        'place_zoom',
        'region',
        'code_number',

    ];
}
