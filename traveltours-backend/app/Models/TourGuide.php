<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TourGuide
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $phone_number
 * @property string|null $address
 *
 * @package App\Models
 */
class TourGuide extends Model
{
    use HasFactory;

	protected $table = 'tour_guides';

	protected $fillable = [
		'name',
		'phone_number',
		'address'
	];

    const INSERT_FIELDS = [
        'name',
        'phone_number',
        'address'
    ];

    const UPDATE_FIELDS = [
        'id',
        'name',
        'phone_number',
        'address'
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'tour_guide_id');
    }
}
