<?php

namespace App\Http\Repositories;

use App\Models\Coupon;

class CouponsRepository extends BaseRepository
{

    public function getModel(): string
    {
        return Coupon::class;
    }

    public function checkCouponCode($couponCode){
        $query = (new $this->_model)->query();
        $today = date("Y-m-d");
        $query = $query->where('code','=',$couponCode)->where('end_date','>=', $today);

        $total = $query->count();
        if($total>0){
            return $query->select('id','discount','threshold')->get();
        }
        return "not exist";
    }
}
