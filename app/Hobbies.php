<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobbies extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'id','firstname','lastname','hobbies','tags'
    ];
}
