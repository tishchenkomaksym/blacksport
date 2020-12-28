<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use TCG\Voyager\Models\Translation;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\Ambassador
 *
 * @property int $id
 * @property string $description
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read null $translated
 * @property-read Collection|Translation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|Ambassador newModelQuery()
 * @method static Builder|Ambassador newQuery()
 * @method static Builder|Ambassador query()
 * @method static Builder|Ambassador whereCreatedAt($value)
 * @method static Builder|Ambassador whereDescription($value)
 * @method static Builder|Ambassador whereId($value)
 * @method static Builder|Ambassador whereImage($value)
 * @method static Builder|Ambassador whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static Builder|Ambassador whereUpdatedAt($value)
 * @method static Builder|Ambassador withTranslation($locale = null, $fallback = true)
 * @method static Builder|Ambassador withTranslations($locales = null, $fallback = true)
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

    public static function translatedFields(){
        return [
            'description'
        ];
    }
}
