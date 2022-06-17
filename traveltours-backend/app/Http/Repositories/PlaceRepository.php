<?php

namespace App\Http\Repositories;

class PlaceRepository extends BaseRepository
{
    protected $_relationships = ['reviews'];

    public function getModel(): string
    {
        return \App\Models\Place::class;
    }
}
