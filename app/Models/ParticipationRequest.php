<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipationRequest extends Model 
{

    protected $table = 'participation_request';
    public $timestamps = true;
    protected $fillable = array('user_id');
    protected $visible = array('program_id');

}