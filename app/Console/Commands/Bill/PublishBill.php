<?php

namespace App\Console\Commands\Bill;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish current month bill';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $bill = Bill::query()->where("month",date("m"))
            ->where("year",date("y"))
            ->where("published_at",null)->count();
        if ($bill == 0){
            $this->info("all bill has been published!");
        }else{
            Bill::query()->where("month",date("m"))
                ->where("year",date("y"))
                ->where("published_at",null)
                ->update(["published_at"=>Carbon::now()]);
            $this->info("bill has been published");
        }
    }
}
