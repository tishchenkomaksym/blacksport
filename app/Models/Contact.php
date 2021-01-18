<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Contact extends Model
{

    use Translatable;

    protected $translatable = [
        'address'
    ];


    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = ['phone', 'email', 'social_links', 'address'];

    public static function translatedFields(){
        return [
            'address'
        ];
    }
}
