<?php

namespace App\Http\Repositories;

use App\Models\Place;

class PlaceRepository extends BaseRepository
{
    protected $_relationships = ['reviews', 'reviews.user'];

    public function getModel(): string
    {
        return Place::class;
    }
}
