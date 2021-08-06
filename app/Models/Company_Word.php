<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_Word extends Model
{
    protected $table = 'company_words';

    protected $primaryKey = 'id';

    protected $fillable =[

         'description',
         'type',
         'vision',
   ];
}
