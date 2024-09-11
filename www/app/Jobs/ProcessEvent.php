<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
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
        usleep(10000);
        echo 'ProcessEvent ' . $this->attempts() . \PHP_EOL;
        $lock = Cache::lock('0191d6ef-a669-7774-9d2d-e2044db90e26', 0, (string) $this->number);
        if ($lock->get()) {
            echo $this->number . ' work' . \PHP_EOL;
            $lock->release();
        } else {
            echo $this->number . ' release' . \PHP_EOL;
            $this->release();
        }
    }
}
