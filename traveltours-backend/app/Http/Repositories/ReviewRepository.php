<?php

namespace App\Http\Repositories;

class ReviewRepository extends BaseRepository
{

    public function getModel(): string
    {
        return \App\Models\Review::class;
    }
}
