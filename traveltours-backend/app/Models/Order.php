<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $tour_id
 * @property int $coupon_id
 * @property int $user_id
 * @property int $child_count
 * @property int $adult_count
 * @property float $total_price
 * @property float $tax
 * @property string $payment_method
 * @property string $status
 *
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;

	protected $table = 'orders';

    const PENNING = 'penning';
    const ACCEPT = 'accept';
    const REJECT = 'reject';

	protected $casts = [
		'tour_id' => 'int',
		'coupon_id' => 'int',
		'user_id' => 'int',
		'child_count' => 'int',
		'adult_count' => 'int',
		'total_price' => 'float',
		'tax' => 'float'
	];

	protected $fillable = [
		'tour_id',
		'coupon_id',
		'user_id',
		'child_count',
		'adult_count',
		'total_price',
		'tax',
		'payment_method',
		'status'
	];

    const INSERT_FIELDS = [
        'tour_id',
        'user_id',
        'child_count',
        'adult_count',
        'total_price',
        'tax',
        'payment_method',
        'status'
    ];

    const UPDATE_FIELDS = [
        'id',
        'tour_id',
        'coupon_id',
        'user_id',
        'child_count',
        'adult_count',
        'total_price',
        'tax',
        'payment_method',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
