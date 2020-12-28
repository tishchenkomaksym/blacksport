<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class ProgramRequest extends Model
{
    use Translatable;

    protected $translatable = [
        'name'
    ];

    protected $table = 'program_request';
    public $timestamps = true;
    protected $fillable = ['program_id', 'name', 'phone', 'email'];

    public static function translatedFields(){
        return [
            'name'
        ];
    }


    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
}
