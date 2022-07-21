<?php

namespace App\Http\Repositories;

use App\Helper;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

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

    public function doList($keyword, $page, $pageSize, $orderBy = ['created_at'], $orderType = ['desc'], $filter): JsonResponse
    {
        $query = Tour::query();

        [$minRating, $price, $duration, $places, $categories] = $filter;
        $query = $this->search($query, $keyword);
        $query = $this->relationships($query);

        if(Schema::hasColumn($this->_model->getTable(), $orderBy)){
            $query = $query->orderBy($orderBy, $orderType);
        }

        if($price != null){
            $query = $query->whereHas('price', function($q) use ($price){
                $q->where('adult', '>', $price[0])
                    ->where('adult', '<', $price[1]);
            });
        }

        if($duration != null){
            $query = $query->whereBetween('range', [$duration[0], $duration[1]]);
        }

        if($places != null){
            $queryPlaces = Place::query();
            foreach ($places as $place){
                $queryPlaces = $queryPlaces->orWhere('name', 'LIKE', "%$place%");
            }
            $places = $queryPlaces->get()->pluck('id')->toArray();

            foreach ($places as $place){
                $query = $query->orWhereRaw("JSON_CONTAINS(places, '$place', '$')");
            }
        }

        $result = $query->get();

        if($categories != null){
            $result = $result->filter(function($item) use ($categories){
                foreach ($categories as $category){
                    $lst = $item->categories;
                    foreach ($lst as $itm){
                        if($itm->name == $category){
                            return true;
                        }
                    }
                }

                return false;
            });

        }

        if($minRating != null){
            $result = $result->filter(function ($item) use ($minRating){
                $avgRating = $item->reviews->avg('star');
                return $avgRating > $minRating;
            });
        }

        $total = count($result);
        $newResult = [];

        foreach ($result->forPage($page - 1, $pageSize) as $item){
            $newResult[] = $item;
        }
        $result = $newResult;

        return \App\Helper::successResponseList($result, $total);
    }
}
