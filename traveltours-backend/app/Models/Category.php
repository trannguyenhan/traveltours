<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $description
 *
 * @package App\Models
 */
class Category extends Model
{
    use HasFactory;

	protected $table = 'categories';

	protected $fillable = [
		'name',
		'description'
	];

    const INSERT_FIELDS = [
        'name',
        'description'
    ];

    const UPDATE_FIELDS = [
        'id',
        'name',
        'description'
    ];

    public function tours(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'tour_category', 'category_id', 'tour_id');
    }
}
