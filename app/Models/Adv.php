<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    protected $table = 'advs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'phone',
        'photo',
        'description',
        'video_link',
        'url',
        'status',
    ];
}
