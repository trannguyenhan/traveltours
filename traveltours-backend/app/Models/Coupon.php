<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Coupon
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $code
 * @property float $discount
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property float $threshold
 *
 * @package App\Models
 */
class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $casts = [
        'discount' => 'float',
        'threshold' => 'float'
    ];

    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'code',
        'discount',
        'start_date',
        'end_date',
        'threshold',
        'tour_id',
        'created_by'
    ];

    const INSERT_FIELDS = [
        'code',
        'discount',
        'start_date',
        'end_date',
        'threshold',
        'tour_id',
        'created_by'
    ];

    const UPDATE_FIELDS = [
        'id',
        'code',
        'discount',
        'start_date',
        'end_date',
        'threshold',
        'tour_id',
        'created_by'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'coupon_id');
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
