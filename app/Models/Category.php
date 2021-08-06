<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'agent_id',
        'status',
        'photo',
        'region_id',

    ];



    //Every regoin Has Many categories
    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

    //Every regoin Has Many categories
    // public function regoin(){
    //     return $this->belongsTo('App\Models\Region');
    // }

    //Every category Has Many categories_media
    public function categories_media(){
        return $this->hasMany('App\Models\Categories_media');
    }

    public function places(){
        return $this->hasMany('App\Models\place');
    }

}
