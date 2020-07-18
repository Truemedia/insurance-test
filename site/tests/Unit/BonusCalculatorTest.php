<?php

namespace Tests\Unit;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use App\Calculator\Pay\BonusCalculator;

class BonusCalculatorTest extends TestCase
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
        $calculator = new BonusCalculator($sameDate);
        $this->assertEquals('2020-06-10', $calculator->payDate()->format('Y-m-d'));

        // Altered date
        $alteredDate = new Carbon('2020-05-01');
        $calculator = new BonusCalculator($alteredDate);
        $this->assertEquals('2020-05-12', $calculator->payDate()->format('Y-m-d'));

        $this->assertTrue(true);
    }
}
