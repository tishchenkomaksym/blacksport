<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use TCG\Voyager\Models\Translation;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\ServicesExapmle
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $media
 * @property-read null $translated
 * @property-read Collection|Translation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|ServicesExapmle newModelQuery()
 * @method static Builder|ServicesExapmle newQuery()
 * @method static Builder|ServicesExapmle query()
 * @method static Builder|ServicesExapmle whereCreatedAt($value)
 * @method static Builder|ServicesExapmle whereDescription($value)
 * @method static Builder|ServicesExapmle whereId($value)
 * @method static Builder|ServicesExapmle whereMedia($value)
 * @method static Builder|ServicesExapmle whereName($value)
 * @method static Builder|ServicesExapmle whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static Builder|ServicesExapmle whereUpdatedAt($value)
 * @method static Builder|ServicesExapmle withTranslation($locale = null, $fallback = true)
 * @method static Builder|ServicesExapmle withTranslations($locales = null, $fallback = true)
 * @mixin \Eloquent
 */
class ServicesExapmle extends Model 
{
    use Translatable;

    protected $translatable = [
        'name', 'description'
    ];

    protected $table = 'services_example';
    public $timestamps = true;
    protected $fillable = ['name', 'description', 'media'];

}