<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Review extends Model
{
    use HasFactory;

    const UPDATE_FIELDS = ['comment', 'user_id', 'star'];
    const INSERT_FIELDS = ['comment', 'user_id', 'star'];
    protected $fillable = ['id', 'comment', 'user_id', 'star'];

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'place_review');
    }
}
