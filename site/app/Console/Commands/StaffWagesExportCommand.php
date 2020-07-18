<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\{Carbon,CarbonPeriod};
use App\Calculator\Pay\{BasicCalculator,BonusCalculator};
use DateInterval;

class StaffWagesExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wages:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        setlocale(LC_MONETARY, 'en_GB');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Date range
        $startDate = Carbon::now();
        $endDate = $startDate->clone()->add(12, 'months');

        // Stream CSV
        $period = new CarbonPeriod($startDate, $endDate, new DateInterval('P1M'));
        $file = fopen('file.csv', 'w');
        
        foreach ($period as $date) {
            // Basic calculator
            $basicCalculator = new BasicCalculator( $date->clone() );

            // Bonus calculator
            $bonusCalculator = new BonusCalculator( $date->clone() );

            fputcsv($file, [
                $date->format('F'), // Month name
                $basicCalculator->toMoneyString(), // Basic pay
                $bonusCalculator->toMoneyString() // Bonus pay
            ]);
        }
        fclose($file);
    }
}
