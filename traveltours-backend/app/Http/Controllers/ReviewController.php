<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ReviewRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Review\StoreRequest;
use App\Http\Requests\Review\UpdateRequest;
use App\Models\Review;

class ReviewController extends BaseController
{
    public function __construct(ReviewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreRequest $request){
        return $this->storeTemplate($request, Review::INSERT_FIELDS);
    }

    public function update(UpdateRequest $request){
        return $this->updateTemplate($request, Review::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request){
        return $this->deleteTemplate($request);
    }
}
