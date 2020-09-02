<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model 
{

    protected $table = 'ambassadors';
    public $timestamps = true;
    protected $fillable = array('description', 'image');

}