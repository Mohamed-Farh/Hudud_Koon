<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
    protected $table = 'aboutus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'aboutus',
        'message',
        'vision',

    ];
}
