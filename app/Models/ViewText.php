<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use TCG\Voyager\Traits\Translatable;

class ViewText extends Model
{

    protected $table = 'view_texts';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['page_id', 'description'];

    use Translatable;

    protected $translatable = [
        'description'
    ];

    public static function translatedFields(){
        return [
            'name', 'description'
        ];
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function images()
    {
        return $this->hasMany(ViewTextImage::class, 'view_texts_id', 'id');
    }
}
