<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TourRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Tour\StoreRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use App\Models\Price;

class TourController extends BaseController
{
    public function __construct(TourRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoreRequest $request)
    {
        $adultPrice = $request->input('adult_price');
        $childPrice = $request->input('child_price');
        $id = Price::insertGetId(
            ['child' =>  $childPrice, 'adult' => $adultPrice]
        );
        $request->price_id = $id;

        $detail =  $this->storeTemplate($request, Tour::INSERT_FIELDS);
        $tourId =  $detail->getData()->data->id;

        if ($request->has('categories')) {
            foreach ($request->input('categories') as $category) {
                DB::table('tour_category')->insert([
                    'tour_id' => $tourId,
                    'category_id' => $category
                ]);
            }
        }
        return $detail;
    }

    public function update(UpdateRequest $request)
    {
        $adultPrice = $request->input('adult_price');
        $childPrice = $request->input('child_price');
        $price = Price::find($request->input('price_id'));
        $price->adult = $adultPrice;
        $price->child = $childPrice;
        $price->save();
        if ($request->has('categories')) {
            $tourId = $request->input('id');
            DB::table('tour_category')->where('tour_id', $tourId)->delete();
            foreach ($request->input('categories') as $category) {
                DB::table('tour_category')->insert([
                    'tour_id' => $tourId,
                    'category_id' => $category
                ]);
            }
        }
        return $this->updateTemplate($request, Tour::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request)
    {
        return $this->deleteTemplate($request);
    }
}
