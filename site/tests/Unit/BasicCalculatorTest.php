<?php

namespace Tests\Unit;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use App\Calculator\Pay\BasicCalculator;

class BasicCalculatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // Same date
        $sameDate = new Carbon('2020-06-01');
        $calculator = new BasicCalculator($sameDate);
        $this->assertEquals('2020-06-30', $calculator->payDate()->format('Y-m-d'));
        
        // Altered date
        $alteredDate = new Carbon('2020-05-01');
        $calculator = new BasicCalculator($alteredDate);              
        $this->assertEquals('2020-05-29', $calculator->payDate()->format('Y-m-d'));
    }
}
