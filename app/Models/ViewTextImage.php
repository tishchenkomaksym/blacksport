<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewTextImage extends Model
{

    protected $table = 'view_texts_images';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['view_texts_id'];


    public function text()
    {
        return $this->belongsTo(ViewText::class, 'view_texts_id', 'id');
    }
}
