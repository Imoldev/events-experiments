<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;

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
        if ($this->number === 1) {
            throw new \Exception('Something went wrong');
        }
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping('stream_id')];
    }
}
