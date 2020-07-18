<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\{Carbon,CarbonPeriod};
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

        // Output CSV
        $period = new CarbonPeriod($startDate, $endDate, new DateInterval('P1M'));
        $file = fopen('file.csv', 'w');
        
        foreach ($period as $date) {
            // Basic pay date
            $basicPaydate = $date->clone()->endOfMonth();
            if ($basicPaydate->isWeekend()) {
                $basicPaydate->previousWeekday();
            }
            $this->info( $basicPaydate->format('Y-m-d') );

            // Bonus pay date
            $bonusPaydate = $date->clone();
            $bonusPaydate->day = 10;
            if ($bonusPaydate->isWeekend()) {
                $bonusPaydate->next('Tuesday');
            }
            $this->info( $bonusPaydate->format('Y-m-d') );

            $basicPay = 1000;
            $bonusPay = 50;

            fputcsv($file, [
                $date->format('F'), // Month name
                $basicPay, // Basic pay
                $bonusPay // Bonus pay
            ]);
        }
        fclose($file);
    }
}
