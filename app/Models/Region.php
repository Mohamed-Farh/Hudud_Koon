<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'status',
        'agent_id',
    ];




    //Every regoin Has Many categories
    // public function categories(){
    //     return $this->hasMany('App\Models\Category');
    // }

    //Every regoin Has Many Places
    public function places(){
        return $this->hasMany('App\Models\Place');
    }

    //Every regoin Has Many categories
    public function user(){
        return $this->belongsTo('App\User');
    }

}
