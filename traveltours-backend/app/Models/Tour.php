<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tour extends Model
{
    use HasFactory;

    const UPDATE_FIELDS = ['id', 'source', 'dest', 'range', 'start_date', 'slot', 'vehicle', 'hotel_star'];
    const INSERT_FIELDS = ['source', 'dest', 'range', 'start_date', 'slot', 'vehicle', 'hotel_star'];
    protected $fillable = ['id', 'source', 'dest', 'range', 'start_date', 'slot', 'vehicle', 'hotel_star'];

    public function placeSource(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'source');
    }

    public function placeDest(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'dest');
    }
}
