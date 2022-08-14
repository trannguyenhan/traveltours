<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\Schema;
use App\Models\Place;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;

class PlaceRepository extends BaseRepository
{
    protected $_relationships = ['reviews', 'reviews.user'];

    public function getModel(): string
    {
        return Place::class;
    }

    public function doListSeller($keyword, $page, $pageSize, $orderBy = ['created_at'], $orderType = ['desc'], $filter): JsonResponse
    {

        $query = Place::query();
        [$created_by] = $filter;
        $query = $this->search($query, $keyword);
        $query = $this->relationships($query);

        // if (Schema::hasColumn($this->_model->getTable(), $orderBy)) {
        //     $query = $query->orderBy($orderBy, $orderType);
        // }
        $result = $query->get();
        if ($created_by != null) {
            $result = $result->filter(function ($item) use ($created_by) {
                return $item->created_by == $created_by;
            });
        }
        $total = count($result);
        $newResult = [];
        foreach ($result->forPage($page, $pageSize) as $item) {
            $newResult[] = $item;
        }
        $result = $newResult;
        return \App\Helper::successResponseList($result, $total);
    }

    public function doDelete($id): JsonResponse
    {
        $allTours =  Tour::query()->get();
        foreach ($allTours as $key => $tour) {
            $listPlaces = $tour->places;
            if (in_array($id, $listPlaces)) {
                $k = array_search((int)$id, $listPlaces, true);
                unset($listPlaces[$k]);
                $to = Tour::find($tour->id);
                $to->places = $listPlaces;
                $to->save();
            }
        }

        return parent::doDelete($id);
    }

    //     public function updateWhenDelete($id){
    // Tour::
    //     }
}
