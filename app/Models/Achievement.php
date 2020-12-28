<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Achievement extends Model
{
    use Translatable;

    protected $table = 'achievements';
    public $timestamps = true;
    protected $fillable = ['title', 'description'];

    protected $translatable = [
        'title', 'description',
    ];

    public static function translatedFields(){
        return [
            'title', 'description'
        ];
    }
}
