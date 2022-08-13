<?php

namespace App\Http\Repositories;

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

    public function checkCouponCode($couponCode)
    {
        $query = (new $this->_model)->query();
        $today = date("Y-m-d");
        $query = $query->where('code', '=', $couponCode)->where('end_date', '>=', $today);

        $total = $query->count();
        if ($total > 0) {
            return $query->select('id', 'discount', 'threshold')->get();
        }
        return "not exist";
    }
}
