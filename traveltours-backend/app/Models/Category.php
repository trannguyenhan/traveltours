<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    const UPDATE_FIELDS = ['id', 'name', 'description'];
    const INSERT_FIELDS = ['name', 'description'];
    protected $fillable = ['id', 'name', 'description'];

    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Tour::class, 'tour_category');
    }
}
