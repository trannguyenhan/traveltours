<?php

namespace App\Http\Repositories;

class PlaceRepository extends BaseRepository
{

    public function getModel()
    {
        return \App\Models\Place::class;
    }
}
