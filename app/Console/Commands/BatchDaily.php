<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use App\Batch;
use Carbon\Carbon;

class BatchDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'menambah batch number setiap hari';

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
        $current_time = Carbon::now('Asia/Jakarta');

        $q=DB::table('tb_batch_number')->select(DB::raw('COUNT(batch_number) as kd_max'));
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ($k->kd_max)+1;
                $kd = sprintf("%d", $tmp);
                Batch::create([
                    'batch_number' => $kd,
                    'created_at' => $current_time->toDateString()
                    ]);
            }
        }
        else
        {
            $kd = "1";
            Batch::create([
                'batch_number' => $kd,
                'created_at' => $current_time
                ]);
        }

        return $kd;
        
    }
}
