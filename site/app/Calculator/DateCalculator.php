<?php namespace App\Calculator;

use Carbon\Carbon;

class DateCalculator
{
    protected $date;

    function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    function total()
    {
        return null;
    }

    function toMoneyString() : string
    {
        $currencySymbol = '£';
        return $currencySymbol . $this->total();
    } 
}