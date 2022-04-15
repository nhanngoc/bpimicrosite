<?php

use Carbon\Carbon;
use App\Models\Period;
use App\Models\CargoType;
use App\Models\Incoterms;
use App\Models\TradeType;
use App\Models\RegionCode;
use App\Models\PaymentTerm;
use App\Models\BusinessType;
use App\Models\LocationCode;

if (!function_exists('checkPaymentTerm')) {
    /**
     * Check Payment term
     * @param array $conditions
     * @return bool|object
     */
    function checkPaymentTerm($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = PaymentTerm::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkIncoterms')) {
    /**
     * Check Incoterms
     * @param array $conditions
     * @return bool|object
     */
    function checkIncoterms($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = Incoterms::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkBusinessType')) {
    /**
     * Check BusinessType
     * @param array $conditions
     * @return bool|object
     */
    function checkBusinessType($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = BusinessType::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkTradeType')) {
    /**
     * Check TradeType
     * @param array $conditions
     * @return bool|object
     */
    function checkTradeType($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = TradeType::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkCargoType')) {
    /**
     * Check CargoType
     * @param array $conditions
     * @return bool|object
     */
    function checkCargoType($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = CargoType::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkLocationCode')) {
    /**
     * Check LocationCode
     * @param array $conditions
     * @return bool
     */
    function checkLocationCode($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = LocationCode::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkBusinessType')) {
    /**
     * Check BusinessType
     * @param array $conditions
     * @return bool
     */
    function checkBusinessType($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = BusinessType::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}

if (!function_exists('checkPeriod')) {
    /**
     * Check Period
     * @param array $conditions
     * @return bool
     */
    function checkPeriod($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = Period::where($conditions)->whereMonth('starting_date', '>=', Carbon::today()->format('m'))
        ->whereYear('starting_date', '>=', Carbon::today()->format('Y'))->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}
if (!function_exists('checkRegion')) {
    /**
     * Check Region
     * @param array $conditions
     * @return bool
     */
    function checkRegion($value, $conditions)
    {
        if (!$value) {
            return false;
        }
        $check = RegionCode::where($conditions)->first();
        if ($check) {
            return $check;
        }
        return false;
    }
}
