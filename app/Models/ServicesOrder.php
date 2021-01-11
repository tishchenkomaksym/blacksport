<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServicesOrder
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int $services_id
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder whereServicesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesOrder whereUserId($value)
 * @mixin \Eloquent
 */
class ServicesOrder extends Model
{

    protected $table = 'services_order';
    public $timestamps = true;
    protected $guarded = [];

}
