<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $name
 * @property string $page_key
 * @property string $meta_description
 * @property int $noindex
 * @property int $nofollow
 * @property string|null $image1
 * @property string|null $image2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImage1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImage2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereNofollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereNoindex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePageKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Page withTranslations($locales = null, $fallback = true)
 * @mixin \Eloquent
 */
class Page extends Model
{
    use Translatable;

    protected $translatable = [
        'name', 'meta_description'
    ];

    protected $table = 'pages';
    public $timestamps = true;
    protected $fillable = ['name',  'page_key', 'meta_description', 'noindex', 'nofollow'];

    public function viewTexts()
    {
        return $this->hasMany(ViewText::class);
    }

    public static function translatedFields(){
        return [
            'name', 'meta_description'
        ];
    }

}
