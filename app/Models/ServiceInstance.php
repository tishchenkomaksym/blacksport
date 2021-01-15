<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use TCG\Voyager\Models\Translation;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\ServiceExapmle
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
 * @method static Builder|ServiceInstance newModelQuery()
 * @method static Builder|ServiceInstance newQuery()
 * @method static Builder|ServiceInstance query()
 * @method static Builder|ServiceInstance whereCreatedAt($value)
 * @method static Builder|ServiceInstance whereDescription($value)
 * @method static Builder|ServiceInstance whereId($value)
 * @method static Builder|ServiceInstance whereMedia($value)
 * @method static Builder|ServiceInstance whereName($value)
 * @method static Builder|ServiceInstance whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static Builder|ServiceInstance whereUpdatedAt($value)
 * @method static Builder|ServiceInstance withTranslation($locale = null, $fallback = true)
 * @method static Builder|ServiceInstance withTranslations($locales = null, $fallback = true)
 * @mixin Eloquent
 */
class ServiceInstance extends Model
{
    use Translatable;

    protected $translatable = [
        'name', 'description'
    ];

    protected $table = 'services_examples';
    public $timestamps = true;
    protected $fillable = ['name', 'description', 'media'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public static function translatedFields(){
        return [
            'name', 'description'
        ];
    }
}
