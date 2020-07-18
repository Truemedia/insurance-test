<?php namespace App\Calculator\Pay;

use Carbon\Carbon;
use App\Calculator\DateCalculator;

class BonusCalculator extends DateCalculator
{
    const BONUS_PAY_PLACEHOLDER = 50; // TODO: Remove placeholder
    const DEFAULT_PAY_DAY = 10;
    const NEXT_PAY_WEEKDAY = 'Tuesday';

    function payDate() : Carbon
    {
        $payDate = $this->date->clone();
        $payDate->day = self::DEFAULT_PAY_DAY;
        if ($payDate->isWeekend()) {
            $payDate->next(self::NEXT_PAY_WEEKDAY);
        }
        return $payDate;
    }

    function total()
    {
        $payDate = $this->payDate();
        return self::BONUS_PAY_PLACEHOLDER; // TODO: Implement logic
    }    
}