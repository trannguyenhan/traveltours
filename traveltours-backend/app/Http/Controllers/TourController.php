<?php

namespace App\Http\Controllers;

use App\Http\Repositories\TourRepository;
use App\Http\Requests\Base\IdRequest;
use App\Http\Requests\Tour\StoreRequest;
use App\Http\Requests\Tour\UpdateRequest;
use App\Models\Tour;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use App\Models\Price;
use App\Models\Order;
use App\Helper;
use App\Models\Category;

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
        if ($minRating != null) {
            $minRating = $minRating['gte'];
        }

        $price = $request->query('price');
        if ($price != null) {
            $price = [$price['gte'] ?? 0, $price['lte'] ?? 999999999];
        }

        $duration = $request->query('duration');
        if ($duration != null) {
            $duration = [$duration['gte'] ?? 0, $duration['lte'] ?? 365];
        }

        $places = $request->query('places');
        if ($places != null) {
            $places = explode(",", $places['all']);
        }

        $categories = $request->query('categories');
        if ($categories != null) {
            $categories = explode(",", $categories['all']);
        }
        $created_by = null;
        $filter = [$minRating, $price, $duration, $places, $categories, $created_by];
        return $this->repository->doList($keyword, $page, $pageSize, $orderBy, $orderType, $filter);
    }

    public function sellerListing(Request $request)
    {
        $keyword = $request->query('keyword');
        $page = $this->getPage($request);
        $pageSize = $this->getPageSize($request);

        [$orderBy, $orderType] = $this->getSort($request);
        $minRating = $request->query('rating');
        if ($minRating != null) {
            $minRating = $minRating['gte'];
        }

        $price = $request->query('price');
        if ($price != null) {
            $price = [$price['gte'] ?? 0, $price['lte'] ?? 999999999];
        }

        $duration = $request->query('duration');
        if ($duration != null) {
            $duration = [$duration['gte'] ?? 0, $duration['lte'] ?? 365];
        }

        $places = $request->query('places');
        if ($places != null) {
            $places = explode(",", $places['all']);
        }

        $categories = $request->query('categories');
        if ($categories != null) {
            $categories = explode(",", $categories['all']);
        }

        $created_by = auth()->id();

        $filter = [$minRating, $price, $duration, $places, $categories, $created_by];
        return $this->repository->doList($keyword, $page, $pageSize, $orderBy, $orderType, $filter);
    }

    public function allSellerListing(Request $request)
    {
        $filter = [null, null, null, null, null, auth()->id()];
        return $this->repository->doList('', -1, 10, 'created_at', 'desc', $filter);
    }

    public function getSort(Request $request): array
    {
        $value = $request->query('sort');
        if (strpos($value, "-") !== false) {
            return [substr($value, 1), "desc"];
        }

        return [$value, "asc"];
    }



    public function store(StoreRequest $request)
    {
        $adultPrice = $request->input('adult_price');
        $childPrice = $request->input('child_price');
        $id = Price::insertGetId(
            ['child' =>  $childPrice, 'adult' => $adultPrice]
        );
        $request->price_id = $id;
        $request->created_by = auth()->id();
        // dd($request);

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
                    'category_id' => $category['id']
                ]);
            }
        }
        return $this->updateTemplate($request, Tour::UPDATE_FIELDS);
    }

    public function delete(IdRequest $request)
    {
        return $this->deleteTemplate($request);
    }
    public function total($tour_id)
    {
        $query = Order::query();
        $listOrders = $query->where('status', '=', 'accept')->where('tour_id', '=', $tour_id)->get();

        $total = 0;
        foreach ($listOrders as $key => $value) {
            $total += (int) $value->total_price;
        }
        return Helper::successResponse($total);
    }

    public function totalHelper($year, $month)
    {
        $seller_id = auth()->id();
        $listTours = Tour::query()->get();
        $array = [];
        foreach ($listTours as $key => $value) {
            if ($value->created_by == $seller_id) {
                $array[] = (int)$value->id;
            }
        }
        $query = Order::query();
        $listOrders = $query->where('status', '=', 'accept')->get();
        $total = 0;
        foreach ($listOrders as $key => $value) {
            if ($value->created_at->format('m') == (string)$month and $value->created_at->format('Y') == (string)$year and in_array($value->tour_id, $array)) {
                $total += (int)$value->total_price;
            }
        }
        return $total;
    }

    public function convertTime($time)
    {
        return json_decode(json_encode(['year' => $time->format("y"), 'month' => $time->format("m")]));
    }

    public function qtourInTime($year, $month)
    {
        $listTours = Tour::query()->get();
        $tours = [];
        foreach ($listTours as $key => $tour) {
            $time = $tour->start_date->addDays($tour->range);
            $yearCheck = $time->year;
            $monthCheck = $time->month;
            if ($yearCheck == $year and $monthCheck == $month) {
                $tours[] = $tour;
            }
        }
        return $tours;
    }

    public function tourInTime($year, $month)
    {
        return Helper::successResponse(self::qtourInTime($year, $month));
    }

    public function turnoverInTime($year, $month)
    {
        $result = [];
        $toursInTime = self::qtourInTime($year, $month);
        $totalMonth = 0;
        foreach ($toursInTime as $key => $tour) {
            $tour_id = $tour->id;
            $query = Order::query();
            $listOrders = $query->where('status', '=', 'accept')->where('tour_id', '=', $tour_id)->get();
            $total = 0;

            foreach ($listOrders as $key => $order) {
                $total += $order->total_price;
                $totalMonth += $order->total_price;
            }
            $tour->total = $total;
            $result[] = $tour;
        }
        return json_decode(json_encode(['total_month' => $totalMonth, 'detail' => $result, 'len' => count($result)]));
    }

    public function thuNhapMoiThang($year, $month)
    {
        return Helper::successResponse(self::turnoverInTime($year, $month));
    }

    public function totalMonth($year, $month)
    {

        return Helper::successResponse(self::totalHelper($year, $month));
    }

    public function totalYear()
    {
        $result = [];
        $now =  Carbon::now();

        for ($i = 1; $i < 13; $i++) {
            $year = $now->format('Y');
            $month = $now->format('m');

            $result[] = json_decode(json_encode(['time' => $now->format("Y-m"), 'total' => self::turnoverInTime($year, $month)]));
            $now = $now->subMonth();
        }
        return Helper::successResponse($result);
    }

    public function totalCategory()
    {
        $allTours = Tour::query()->get()[0];
        $allCategory = Category::query()->get();
        $arrCategory = [];
        foreach ($allCategory as $key => $cate) {
            $arrCategory[] = json_decode(json_encode(['id' => $cate->id, 'name' => $cate->name, 'count' => 0]));
        }
        $results = DB::select('select category_id from tour_category category ');
        foreach ($results as $key => $item) {
            foreach ($arrCategory as $key => $category) {
                if ($item->category_id == $category->id) {
                    $category->count++;
                }
            }
        }
        return Helper::successResponse($arrCategory);
    }
}
