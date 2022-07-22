<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Tour
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $dest
 * @property int $tour_guide_id
 * @property int $price_id
 * @property int $range
 * @property Carbon $start_date
 * @property string $vehicle
 * @property int $hotel_star
 * @property string $schedule
 * @property string $places
 * @property int $max_slot
 * @property int $slot
 *
 * @package App\Models
 */
class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';

    protected $casts = [
        'dest' => 'int',
        'tour_guide_id' => 'int',
        'price_id' => 'int',
        'range' => 'int',
        'hotel_star' => 'int',
        'max_slot' => 'int',
        'slot' => 'int',
        'places' => 'array',
    ];

    protected $dates = [
        'start_date'
    ];

    protected $fillable = [
        'dest',
        'tour_guide_id',
        'price_id',
        'range',
        'start_date',
        'vehicle',
        'hotel_star',
        'schedule',
        'places',
        'max_slot',
        'slot',
        'name'
    ];

    const INSERT_FIELDS = [
        'dest',
        'tour_guide_id',
        'price_id',
        'range',
        'start_date',
        'vehicle',
        'hotel_star',
        'schedule',
        'places',
        'max_slot',
        'slot',
        'name'
    ];

    const UPDATE_FIELDS = [
        'id',
        'dest',
        'tour_guide_id',
        'price_id',
        'range',
        'start_date',
        'vehicle',
        'hotel_star',
        'schedule',
        'places',
        'max_slot',
        'slot',
        'name'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'tour_category', 'tour_id', 'category_id');
    }

    public function dest(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'dest');
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class, 'price_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'object_id')
            ->where('type', 'tour');
    }

    public function tour_guide(): BelongsTo
    {
        return $this->belongsTo(TourGuide::class, 'tour_guide_id');
    }


}
