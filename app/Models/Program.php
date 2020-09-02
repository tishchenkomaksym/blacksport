<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model 
{

    protected $table = 'programs';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'images');

}