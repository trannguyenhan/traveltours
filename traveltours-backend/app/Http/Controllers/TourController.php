<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TourRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Tour\StoreRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Models\Tour;

class TourController extends Controller
{
    public function __construct(TourRepository $repository)
    {
        $this->repository = $repository;
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
