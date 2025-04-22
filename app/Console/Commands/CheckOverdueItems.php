<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrowed;
use Carbon\Carbon;
use App\Mail\OverdueItemNotification;
use Illuminate\Support\Facades\Mail;

class CheckOverdueItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:overdue-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for overdue items and send email notifications';

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
        $overdueItems = Borrowed::where('stat', 'Borrowed')
            ->where('dateretured', '<', Carbon::now()->subDays(5)->toDateString())
            ->get();
        
        $sentCount = 0;
        foreach($overdueItems as $item) {
            if($item->email) {
                Mail::to($item->email)->send(new OverdueItemNotification($item));
                $sentCount++;
            }
        }
        
        $this->info("Overdue check completed. {$sentCount} notifications sent.");
        
        return 0;
    }
}
