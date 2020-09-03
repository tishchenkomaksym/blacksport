<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ParticipationRequest
 *
 * @property int $id
 * @property int $program_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipationRequest whereUserId($value)
 * @mixin \Eloquent
 */
class ParticipationRequest extends Model 
{

    protected $table = 'participation_request';
    public $timestamps = true;
    protected $fillable = array('user_id');
    protected $visible = array('program_id');

}