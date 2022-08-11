<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PlaceRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Place\StoreRequest;
use App\Http\Requests\Place\UpdateRequest;
use App\Models\Place;
use \App\Helper;
use Illuminate\Http\Request;

class PlaceController extends BaseController
{
    public function __construct(PlaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sellerListing(Request $request)
    {
        $listPlaces = $this->listing($request)->getData()->data;
        $created_by = auth()->id();
        $detail = [];
        foreach ($listPlaces as $key => $value) {
            if ($value->created_by == $created_by)
                $detail[] = $value;
        }
        return Helper::successResponse($detail);
    }

    public function store(StoreRequest $request)
    {
        if ($request->hasFile('images')) {
            $listImg = [];
            foreach ($request->file('images') as $image) {
                $updateImg = Helper::updateImageUrl($image, $option = ['type' => 'place', 'id' => null]);
                if ($updateImg['code'] == 1) {
                    $listImg[] = null;
                } else {
                    $listImg[] = $updateImg['url'];
                }
            }

            $request->created_by = auth()->id();
            $request->images = $listImg;
        }



        return $this->storeTemplate($request, Place::INSERT_FIELDS);
    }

    public function update(UpdateRequest $request)
    {
        if ($request->hasFile('images')) {
            $listImg = [];
            foreach ($request->file('images') as $image) {
                $updateImg = Helper::updateImageUrl($image, $option = ['type' => 'place', 'id' => $request->input("id")]);
                if ($updateImg['code'] == 1) {
                    $listImg[] = null;
                } else {
                    $listImg[] = $updateImg['url'];
                }
            }


            $request->images = $listImg;
            $request->created_by = auth()->id();
        }
        return $this->updateTemplate($request, Place::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request)
    {
        return $this->deleteTemplate($request);
    }
}
