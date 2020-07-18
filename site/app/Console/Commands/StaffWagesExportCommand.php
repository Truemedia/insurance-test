<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\{Carbon,CarbonPeriod};

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $startDate = '2020-05-01';
        $endDate = '2020-06-01';
        $date = $startDate;
        // Basic pay date
        $basicPaydate = Carbon::parse($date)->endOfMonth();
        if ($basicPaydate->isWeekend()) {
            $basicPaydate->previousWeekday();
        }
        $this->info( $basicPaydate->format('Y-m-d') );
        // Bonus pay date
        $bonusPaydate = Carbon::parse($date);
        $bonusPaydate->day = 10;
        if ($bonusPaydate->isWeekend()) {
            $bonusPaydate->next('Tuesday');
        }
        $this->info( $bonusPaydate->format('Y-m-d') );

        $period = CarbonPeriod::create($startDate, $endDate);
        $file = fopen('file.csv', 'w');
        foreach ($period as $dt) {
            fputcsv($file, [$dt->format('Y-m-d')]);
        }
        fclose($file);
    }
}
