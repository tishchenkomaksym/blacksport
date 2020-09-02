<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesExapmle extends Model 
{

    protected $table = 'services_example';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'media');

}