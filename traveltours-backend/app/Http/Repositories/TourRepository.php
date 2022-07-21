<?php

namespace App\Http\Repositories;

use App\Helper;
use App\Models\Place;
use Illuminate\Http\JsonResponse;

class TourRepository extends BaseRepository
{
    protected $_relationships = ['categories', 'dest', 'price', 'reviews', 'reviews.user', 'tour_guide'];

    public function getModel(): string
    {
        return \App\Models\Tour::class;
    }

    public function detail($id): JsonResponse
    {
        $query = (new $this->_model)->query();
        $query = $this->relationships($query);
        $modelDetail = $query->find($id);
        $arrPlace = $modelDetail->places;
        $listDetailPlace = [];

        foreach ($arrPlace as $placeId) {
            $listDetailPlace[] = Place::query()->where('id', $placeId)->get()[0];
        }
        $modelDetail->places_detail = $listDetailPlace;


        return Helper::successResponse($modelDetail);
    }


}
