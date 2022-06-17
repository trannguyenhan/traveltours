<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Price
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property float|null $child
 * @property float $adult
 *
 * @package App\Models
 */
class Price extends Model
{
    use HasFactory;

	protected $table = 'prices';

	protected $casts = [
		'child' => 'float',
		'adult' => 'float'
	];

	protected $fillable = [
		'child',
		'adult'
	];

    const INSERT_FIELDS = [
        'child',
        'adult'
    ];

    const UPDATE_FIELDS = [
        'id',
        'child',
        'adult'
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'price_id');
    }
}
