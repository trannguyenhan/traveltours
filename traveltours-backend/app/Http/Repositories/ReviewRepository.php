<?php

namespace App\Http\Repositories;

class ReviewRepository extends BaseRepository
{

    public function getModel()
    {
        return \App\Models\Review::class;
    }
}
