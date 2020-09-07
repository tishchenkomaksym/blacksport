<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use TCG\Voyager\Models\Translation;
use TCG\Voyager\Traits\Translatable;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $delivery
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read null $translated
 * @property-read Collection|Translation[] $translations
 * @property-read int|null $translations_count
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDelivery($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereProductId($value)
 * @method static Builder|Order whereTranslation($field, $operator, $value = null, $locales = null, $default = true)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @method static Builder|Order withTranslation($locale = null, $fallback = true)
 * @method static Builder|Order withTranslations($locales = null, $fallback = true)
 * @mixin Eloquent
 */
class Order extends Model 
{
    use Translatable;

    protected $translatable = [
        'delivery'
    ];

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = ['user_id', 'product_id', 'delivery'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}