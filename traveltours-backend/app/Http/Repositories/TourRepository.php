<?php

namespace App\Http\Repositories;

class TourRepository extends BaseRepository
{

    public function getModel()
    {
        return \App\Models\Tour::class;
    }
}
