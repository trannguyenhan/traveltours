<?php

namespace App\Http\Repositories;

class TourRepository extends BaseRepository
{
    protected $_relationships = ['categories', 'dest', 'price', 'reviews', 'reviews.user', 'tour_guide'];

    public function getModel(): string
    {
        return \App\Models\Tour::class;
    }
}
