<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewTextImage extends Model
{

    protected $table = 'view-texts-images';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['view-texts_id'];


    public function text()
    {
        return $this->belongsTo(ViewText::class, 'view-texts_id', 'id');
    }
}