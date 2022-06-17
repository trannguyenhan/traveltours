<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Review
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $comment
 * @property int $user_id
 * @property float $star
 * @property int $place_id
 *
 * @package App\Models
 */
class Review extends Model
{
    use HasFactory;

	protected $table = 'reviews';

	protected $casts = [
		'user_id' => 'int',
		'star' => 'float',
		'place_id' => 'int'
	];

	protected $fillable = [
		'comment',
		'user_id',
		'star',
		'object_id',
        'type'
	];

    const INSERT_FIELDS = [
        'comment',
        'user_id',
        'star',
        'object_id',
        'type'
    ];

    const UPDATE_FIELDS = [
        'id',
        'comment',
        'user_id',
        'star',
        'object_id',
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
