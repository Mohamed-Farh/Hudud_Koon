<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories_media extends Model
{
    protected $table = 'categories_media';

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'path',
    ];

    //Every Categories_media belongsTo one  category
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

}
