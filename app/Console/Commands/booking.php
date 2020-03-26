<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class booking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更改预约时间超时且未完成的状态';

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
     * @return mixed
     */
    public function handle()
    {
       DB::table('bookings')->where('complete',0)->whereDate('booking_time','<',date("Y-m-d"))->update(['complete'=>2]);
    }
}
