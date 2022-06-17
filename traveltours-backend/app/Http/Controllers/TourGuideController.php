<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TourGuideRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\TourGuide\StoreRequest;
use App\Http\Requests\TourGuide\UpdateRequest;
use App\Models\TourGuide;

class TourGuideController extends BaseController
{
    public function __construct(TourGuideRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreRequest $request){
        return $this->storeTemplate($request, TourGuide::INSERT_FIELDS);
    }

    public function update(UpdateRequest $request){
        return $this->updateTemplate($request, TourGuide::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request){
        return $this->deleteTemplate($request);
    }
}
