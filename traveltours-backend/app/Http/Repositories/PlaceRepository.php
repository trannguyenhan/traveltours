<?php

namespace App\Http\Repositories;
use Illuminate\Support\Facades\Schema;
use App\Models\Place;
use Illuminate\Http\JsonResponse;
class PlaceRepository extends BaseRepository
{
    protected $_relationships = ['reviews', 'reviews.user'];

    public function getModel(): string
    {
        return Place::class;
    }

    public function doList($keyword, $page, $pageSize, $orderBy = ['created_at'], $orderType = ['desc'], $filter): JsonResponse
    {

        $query = Place::query();
        [ $created_by] = $filter;
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
}
