<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class ProcessEvent implements ShouldQueue
{
    use Queueable;

    public $tries = 0;


    /**
     * Create a new job instance.
     */
    public function __construct( public int $number)
    {
        //
    }



    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(1);
        $lock = Cache::lock('events_lock', 0, (string)$this->number);
        if ($lock->get()) {
            if ($this->number === 1) {
                throw new \Exception('Something went wrong');
            }
            $lock->release();
        } else {
            
        };

    }

}
