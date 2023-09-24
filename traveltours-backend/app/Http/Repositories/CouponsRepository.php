<?php

namespace App\Http\Repositories;

use App\Helper;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponsRepository extends BaseRepository
{
    protected $_relationships = ['tour'];
    public function getModel(): string
    {
        return Coupon::class;
    }
    public function doStore($arr): JsonResponse
    {
        $arr['created_by'] = auth()->id();
        return parent::doStore($arr);
    }
    public function doList($keyword, $page, $pageSize, $orderBy = ['created_at'], $orderType = ['desc'], $filter): JsonResponse
    {
        $couponList = Coupon::all();
        $result = [];
        foreach ($couponList as $key => $coupon) {
            if (str_contains(strtolower($coupon->tour->name), strtolower($keyword))) {
                $result[] = $coupon;
            }
        }
        return Helper::successResponse($result);
    }

    public function checkCouponCode($couponCode, $tour_id, $seller_id)
    {
        $query = (new $this->_model)->query();
        $today = date("Y-m-d");
        $query = $query->where('code', '=', $couponCode)
            ->where('end_date', '>=', $today)
            ->where('start_date', '<=', $today)
            ->where('tour_id', '=', $tour_id)
            ->where('created_by', '=', $seller_id);

        $total = $query->count();
        if ($total > 0) {
            return $query->select('id', 'discount', 'threshold')->get();
        }
        return "not exist";
    }
}
