<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\Ambassador
 *
 * @property int $id
 * @property string $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Ambassador withTranslations($locales = null, $fallback = true)
 * @mixin \Eloquent
 */
class Ambassador extends Model 
{
    use Translatable;

    protected $table = 'ambassadors';
    public $timestamps = true;
    protected $fillable = ['description', 'image'];

    protected $translatable = [
        'description',
    ];

}