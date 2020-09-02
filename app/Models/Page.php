<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model 
{

    protected $table = 'pages';
    public $timestamps = true;
    protected $fillable = array('name', 'name', 'page_key', 'meta_description', 'noindex', 'nofollow', 'image1', 'image2');

}