<?php

namespace App\Http\Repositories;

use Illuminate\Http\JsonResponse;
use \App\Models\Tour;
use App\Helper;
use App\Models\Place;

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
        $list_detail_place = [];
        foreach ($arrPlace as $placeId) {
            $list_detail_place[] = Place::query()->where('id', $placeId)->get();
        }
        $modelDetail->places = $list_detail_place;

        return Helper::successResponse($modelDetail);
    }
}
