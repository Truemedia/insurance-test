<?php namespace App\Calculator\Pay;

use Carbon\Carbon;
use App\Calculator\DateCalculator;

class BasicCalculator extends DateCalculator
{
    const BASIC_PAY_PLACEHOLDER = 1000; // TODO: Remove placeholder

    function payDate() : Carbon
    {
        $payDate = $this->date->clone()->endOfMonth();
        if ($payDate->isWeekend()) {
            $payDate->previousWeekday();
        }
        return $payDate;
    }

    function total() : float
    {
        $payDate = $this->payDate();
        return self::BASIC_PAY_PLACEHOLDER; // TODO: Implement logic
    }    
}