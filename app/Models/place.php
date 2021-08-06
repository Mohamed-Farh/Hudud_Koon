<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    protected $table = 'places';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'phone',
        'photo',
        'description',
        'url',
        'map',
        'category_id',
        'region_id',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    //Every regoin Has Many Places
    public function regoin(){
        return $this->belongsTo('App\Models\Region');
    }

    public function discounts(){
        return $this->hasMany('App\Models\Discount');
    }
}
