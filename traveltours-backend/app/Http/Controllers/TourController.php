<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TourRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Tour\StoreRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends BaseController
{
    public function __construct(TourRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listing(Request $request)
    {
        $keyword = $request->query('keyword');
        $page = $this->getPage($request);
        $pageSize = $this->getPageSize($request);

        [$orderBy, $orderType] = $this->getSort($request);
        $minRating = $request->query('rating');
        if($minRating != null){
            $minRating = $minRating['gte'];
        }

        $price = $request->query('price');
        if($price != null){
            $price = [$price['gte'] ?? 0, $price['lte'] ?? 999999999];
        }

        $duration = $request->query('duration');
        if($duration != null){
            $duration = [$duration['gte'] ?? 0, $duration['lte'] ?? 365];
        }

        $places = $request->query('places');
        if($places != null){
            $places = explode(",", $places['all']);
        }

        $categories = $request->query('categories');
        if($categories != null){
            $categories = explode(",", $categories['all']);
        }

        $filter = [$minRating, $price, $duration, $places, $categories];
        return $this->repository->doList($keyword, $page, $pageSize, $orderBy, $orderType, $filter);
    }

    public function getSort(Request $request): array
    {
        $value = $request->query('sort');
        if(strpos($value, "-") !== false){
            return [substr($value, 1), "desc"];
        }

        return [$value, "asc"];
    }

    public function store(StoreRequest $request){
        return $this->storeTemplate($request, Tour::INSERT_FIELDS);
    }

    public function update(UpdateRequest $request){
        return $this->updateTemplate($request, Tour::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request){
        return $this->deleteTemplate($request);
    }
}
