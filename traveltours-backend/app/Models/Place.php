<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory;

    const UPDATE_FIELDS = ['id', 'province', 'district', 'address_detail', 'name', 'description', 'images'];
    const INSERT_FIELDS = ['province', 'district', 'address_detail', 'name', 'description', 'images'];
    protected $fillable = ['id', 'province', 'district', 'address_detail', 'name', 'description', 'images'];

    protected $casts = [
        'images' => 'array'
    ];

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Review::class, 'place_review');
    }
}
