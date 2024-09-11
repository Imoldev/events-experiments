<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Cache;

class ProcessEventWithErrors implements ShouldQueue
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
        usleep(10000);
        echo 'ProcessEventWithErrors ' . $this->attempts() . \PHP_EOL;
        $lock = Cache::lock('0191d6ee-26d3-7254-84ec-3bab683315c6', 0, (string) $this->number);
        if ($lock->get()) {
            echo $this->number . ' work' . \PHP_EOL;
            if ($this->attempts() < 15) {
                throw new \Exception('Something went wrong');
            }
            $lock->release();
        } else {
            echo $this->number . ' release' . \PHP_EOL;
            $this->release();
        }
    }
}
