<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $images
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $published
 * @property-read null $translated
 * @property-read \Illuminate\Database\Eloquent\Collection|\TCG\Voyager\Models\Translation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News withTranslation($locale = null, $fallback = true)
 * @method static \Illuminate\Database\Eloquent\Builder|News withTranslations($locales = null, $fallback = true)
 * @mixin \Eloquent
 */
class News extends Model
{
    use Translatable;

    protected $translatable = [
        'title', 'description'
    ];

    protected $table = 'news';
    public $timestamps = true;
    protected $fillable = ['title', 'description', 'images', 'published', 'hide_date', 'preview_image'];

    public static function translatedFields(){
        return [
            'title', 'description'
        ];
    }

}
