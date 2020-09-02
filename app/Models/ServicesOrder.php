<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesOrder extends Model 
{

    protected $table = 'services_order';
    public $timestamps = true;
    protected $fillable = array('user_id', 'services_id');

}