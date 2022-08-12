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
        $keyword = $request->query('keyword');
        $page = $this->getPage($request);
        $pageSize = $this->getPageSize($request);
        $orderBy = ['created_at'];
        $orderType = ['desc'];
        $created_by = auth()->id();
        $filter = [$created_by];
        return $this->repository->doList($keyword, $page, $pageSize, $orderBy, $orderType, $filter);
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
