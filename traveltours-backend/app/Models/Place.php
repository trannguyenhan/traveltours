<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Place
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $province
 * @property string $district
 * @property string $address_detail
 * @property string $name
 * @property string $description
 * @property array $images
 *
 * @package App\Models
 */
class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $casts = [
        'images' => 'json',
    ];

    protected $fillable = [
        'province',
        'district',
        'ward',
        'address_detail',
        'name',
        'description',
        'images'
    ];

    const INSERT_FIELDS = [
        'province',
        'district',
        'ward',
        'address_detail',
        'name',
        'description',
        'images'
    ];

    const UPDATE_FIELDS = [
        'id',
        'province',
        'district',
        'ward',
        'address_detail',
        'name',
        'description',
        'images'
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'object_id')
            ->where('type', 'place');
    }

    /**
     * dest column is represented place of  tour
     * method get all tour have represented is this place
     * @return HasMany
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'dest');
    }
}
