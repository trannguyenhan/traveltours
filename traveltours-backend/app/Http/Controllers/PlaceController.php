<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PlaceRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Place\StoreRequest;
use App\Http\Requests\Place\UpdateRequest;
use App\Models\Place;

class PlaceController extends BaseController
{
    public function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreRequest $request){
        return $this->storeTemplate($request, Place::INSERT_FIELDS);
    }

    public function update(UpdateRequest $request){
        return $this->updateTemplate($request, Place::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request){
        return $this->deleteTemplate($request);
    }
}
