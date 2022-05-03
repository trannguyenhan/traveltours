<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tour extends Model
{
    use HasFactory;

    const UPDATE_FIELDS = ['id', 'source', 'dest', 'range', 'start_date', 'slot', 'vehicle', 'hotel_star', 'price', 'old_price'];
    const INSERT_FIELDS = ['source', 'dest', 'range', 'start_date', 'slot', 'vehicle', 'hotel_star', 'price', 'old_price'];
    protected $fillable = ['id', 'source', 'dest', 'range', 'start_date', 'slot', 'vehicle', 'hotel_star', 'price', 'old_price'];

    public function placeSource(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'source');
    }

    public function placeDest(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'dest');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'tour_category');
    }
}
