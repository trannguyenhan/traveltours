<?php

namespace App\Http\Repositories;

use App\Models\TourGuide;

class TourGuideRepository extends BaseRepository
{
    public function getModel(): string
    {
        return TourGuide::class;
    }
}
