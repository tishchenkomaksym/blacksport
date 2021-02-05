<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $description
 * @property int|null $services_example_id
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereServicesExampleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Service withTranslations($locales = null, $fallback = true)
 * @mixin \Eloquent
 */
class Service extends Model
{
    use Translatable;

    protected $translatable = [
        'name', 'description'
    ];

    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = ['name', 'description', 'show_on_main'];

    public function examples()
    {
        return $this->hasMany(ServiceInstance::class, 'service_id', 'id');
    }

    public static function translatedFields(){
        return [
            'name', 'description'
        ];
    }

}
